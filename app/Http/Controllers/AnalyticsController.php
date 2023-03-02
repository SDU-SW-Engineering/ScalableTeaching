<?php

namespace App\Http\Controllers;

use App\Models\Casts\SubTask;
use App\Models\Casts\SubTaskCollection;
use App\Models\Course;
use App\Models\Group;
use App\Models\Project;
use App\Models\ProjectSubTask;
use App\Models\Task;
use App\Models\User;
use Domain\Analytics\Graph\DataSets\BarDataSet;
use Domain\Analytics\Graph\DataSets\LineDataSet;
use Domain\Analytics\Graph\Graph;
use GraphQL\Client;
use GraphQL\SchemaObject\RootProjectsArgumentsObject;
use GraphQL\SchemaObject\RootQueryObject;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class AnalyticsController extends Controller
{
    public function pushes(Course $course, Task $task) : View
    {
        $pushes = $task->pushes()->with(['project.ownable'])->latest()->paginate(50);

        return view('tasks.admin.pushes', compact('pushes'));
    }

    public function taskCompletion(Course $course, Task $task) : View
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

        return view('tasks.admin.taskCompletion', compact('subtasks', 'maxPointsPerTask'));
    }

    public function gradingOverview(Course $course, Task $task) : View
    {
        return view('tasks.admin.gradingOverview');
    }
}
