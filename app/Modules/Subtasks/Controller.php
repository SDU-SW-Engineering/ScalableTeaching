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
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Maatwebsite\Excel\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class Controller extends BaseController
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

        $maxPointsPerTask = $task->sub_tasks->all()->pluck('points', 'id');

        $subtasks = $task->sub_tasks->all()->groupBy('group')->map(fn(Collection $subTasks, $group) => [
            'group'     => $group,
            'average'   => round($completionPercentages->filter(fn($v, $k) => $subTasks->pluck('id')->contains($k))->sum(), 2),
            'maxPoints' => $subTasks->sum(fn(SubTask $task) => $task->getPoints()),
            'tasks'     => $subTasks->map(function(SubTask $subTask) use ($maxPointsPerTask, $completionPercentages) {
                $taskAverage = $completionPercentages->has($subTask->getId()) ? $completionPercentages[$subTask->getId()] : 0;
                $maxPoints = $maxPointsPerTask->get($subTask->getId());

                return [
                    'id'         => $subTask->getId(),
                    'isRequired' => $subTask->isRequired(),
                    'name'       => $subTask->getDisplayName(),
                    'maxPoints'  => $subTask->getPoints(),
                    'average'    => $taskAverage,
                    'percentage' => round($taskAverage / $maxPoints * 100),
                ];
            }),
        ]);


        //die();
        return view('module-Subtasks::Pages.taskCompletion', compact('subtasks', 'maxPointsPerTask'));
    }

    public function taskCompletion(Course $course, Task $task): View
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
        $task->save();

        return "OK";
    }
    public function exportResults(Course $course, Task $task, Excel $excel): BinaryFileResponse
    {
        return $excel->download(new SubtaskCompletionExport($task), "$task->name Subtask Points.xlsx");
    }
}
