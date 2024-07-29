<?php

namespace App\Modules\Subtasks;

use App\Exports\SubtaskCompletionExport;
use App\Http\Controllers\Controller as BaseController;
use App\Models\Casts\SubTask;
use App\Models\Casts\SubTaskCollection;
use App\Models\Course;
use App\Models\Project;
use App\Models\ProjectSubTask;
use App\Models\Task;
use App\Modules\AutomaticGrading\AutomaticGrading;
use App\Modules\AutomaticGrading\AutomaticGradingSettings;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Maatwebsite\Excel\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class SubtasksController extends BaseController
{
    public function subTasks(Course $course, Task $task): View
    {
        $subTasks = $task->sub_tasks->all()->groupBy("group")->map(fn($tasks, $group) => [
            'name'  => $group,
            'tasks' => $tasks->map(fn(SubTask $t) => [
                'id'     => $t->id,
                'name'   => $t->getName(),
                'points' => $t->points,
            ]),
        ])->values();

        return view('module-Subtasks::Pages.subtasks', [
            'subTasks' => $subTasks,
        ]);
    }

    public function aggregatedTaskCompletion(Course $course, Task $task) : View
    {
        $projectIds = $task->projects()->pluck('id');

        $completionPercentages = ProjectSubTask::whereIn('project_id', $projectIds)
            ->select(\DB::raw('sub_task_id, avg(points) as points'))
            ->groupBy('sub_task_id')
            ->pluck('points', 'sub_task_id');

        $subtaskGroups = $task->sub_tasks->all()->groupBy('group')->map(fn(Collection $subTasks, $group) => [
            'group'     => $group,
            'average'   => round($completionPercentages->filter(fn($v, $k) => $subTasks->pluck('id')->contains($k))->sum(), 2),
            'maxPoints' => $subTasks->sum(fn(SubTask $task) => $task->getPoints()),
            'tasks'     => $subTasks->map(function(SubTask $subTask) use ($completionPercentages) {
                $taskAverage = $completionPercentages[$subTask->getId()] ?? 0;
                $maxPoints = $subTask->getPoints() ?? 0;

                return [
                    'name'       => $subTask->getDisplayName(),
                    'maxPoints'  => $subTask->getPoints(),
                    'average'    => $taskAverage,
                    'percentage' => round($taskAverage / $maxPoints * 100),
                ];
            }),
        ]);

        return view('module-Subtasks::Pages.aggregateTaskCompletion', compact('subtaskGroups'));
    }

    public function studentTaskCompletion(Course $course, Task $task): View
    {
        $subTasks = $task->sub_tasks->all()->keyBy('id');
        $projects = $task->projects()->claimed()->get()->map(function(Project $project) use ($subTasks) {
            return [
                'groups' => $project->subtasks->groupBy(fn(ProjectSubTask $subTask) => $subTasks[$subTask->sub_task_id]->group),
                'name'   => $project->ownerNames,
            ];
        })->sortBy('name');
        $groups = $subTasks->mapWithKeys(fn($task) => [$task->group => $task->group]);

        return view('module-Subtasks::Pages.studentTaskCompletion', compact('projects', 'groups'));
    }


    public function saveSubTasks(Course $course, Task $task): string
    {
        $subTaskCollection = new SubTaskCollection();
        (new Collection(request()->json()))->map(fn($group) => [
            ...(new Collection($group['tasks']))->map(function($task) use ($group) {
                abort_if($task['points'] == 0, 400, "Unable to save: \"{$task['name']}\" must have more then 0 points");
                $subTask = new SubTask($task['name'], null, $group['name']);
                $subTask->setPoints($task['points']);
                if($task['id'] != null)
                    $subTask->setId($task['id']);

                return $subTask;
            }),
        ])->flatten()
            ->each(fn(SubTask $subTask) => $subTaskCollection->add($subTask));
        $task->sub_tasks = $subTaskCollection;

        if ($task->module_configuration->isEnabled(AutomaticGrading::class))
        { // Remove any tasks that was required, if removed from the list of subtasks
            /** @var AutomaticGradingSettings $settings */
            $settings = $task->module_configuration->resolveModule(AutomaticGrading::class)->settings();
            $subTaskIds = $task->sub_tasks->all()->pluck('id');
            $settings->requiredSubtaskIds = array_filter($settings->requiredSubtaskIds, fn(int $requiredSubtaskId) => $subTaskIds->contains($requiredSubtaskId));
            $task->module_configuration->update(AutomaticGrading::class, $settings, $task);
        }

        $task->save();

        return "OK";
    }
    public function exportResults(Course $course, Task $task, Excel $excel): BinaryFileResponse
    {
        return $excel->download(new SubtaskCompletionExport($task), "$task->name Subtask Points.xlsx");
    }
}
