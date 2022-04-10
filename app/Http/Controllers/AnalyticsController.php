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
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class AnalyticsController extends Controller
{

    public function index(Course $course, Task $task)
    {
        $projectCount = $task->projects()->count();
        $projectsToday = $task->projects()->whereRaw('date(created_at) = ?', now()->toDateString())->count();
        $finishedCount = $task->projects()->where('status', 'finished')->count();
        $finishedPercent = $projectCount == 0 ? 0 : $finishedCount / $projectCount * 100;
        $failedCount = $task->projects()->where('status', 'failed')->count();
        $failedPercent = $projectCount == 0 ? 0 : $failedCount / $projectCount * 100;
        $buildCount = $task->jobs()->count();
        $buildsToday = $task->jobs()->whereRaw("date(pipelines.created_at) = ?", now()->toDateString())->withTrashedParents()->count();

        $projectQuery = $task->projects()
            ->select('*', \DB::raw('TIMESTAMPDIFF(second,created_at, finished_at) as duration'))
            ->withCount('pipelines')
            ->orderBy(request('sort', 'created_at'), request('direction', 'desc'));

        if(request('status', 'all') != 'all')
            $projectQuery->where('status', request('status', 'active'));

        $projects = $projectQuery->paginate(10)->withQueryString();

        $totalProjectsPerDay = $task->totalProjectsPerDay;
        $projectsCompletedPerDay = $task->totalCompletedTasksPerDay;
        $totalProjectsPerDayGraph = new Graph($totalProjectsPerDay->keys(),
            new LineDataSet("Projects", $totalProjectsPerDay, "#266ab0", true),
            new LineDataSet("Completed", $projectsCompletedPerDay, "#7BB026", true)
        );

        $dailyBuilds = $task->dailyBuilds(true, true);
        $dailyBuildsGraph = new Graph($dailyBuilds->keys(), new BarDataSet("Builds", $dailyBuilds, "#4F535B"));
        $breadcrumbs = [
            'Courses'     => route('courses.index'),
            $course->name => route('courses.show', $course->id),
            $task->name   => route('courses.tasks.show', [$course->id, $task->id]),
            'Analytics'   => null
        ];

        return view('tasks.analytics.index', compact('course', 'task', 'projectCount', 'breadcrumbs',
            'projectsToday', 'finishedCount', 'finishedPercent', 'failedCount', 'failedPercent', 'buildCount', 'buildsToday',
            'totalProjectsPerDayGraph', 'dailyBuildsGraph', 'projects'));
    }

    public function builds(Course $course, Task $task)
    {
        $dailyBuilds = $task->dailyBuilds(true, true);
        $activeIndex = $dailyBuilds->keys()->search(\request('q'));
        $dailyBuildsGraph = new Graph($dailyBuilds->keys(), new BarDataSet("Builds", $dailyBuilds, "#4F535B", $activeIndex === false ? null : $activeIndex));
        $buildQuery = $task->jobs();

        if(\request('q') != null)
            $buildQuery->whereRaw('date(job_statuses.created_at) = ?', \request('q'));

        if(\request('status') != null)
            $buildQuery->where('job_statuses.status', \request('status'));

        $buildQuery->latest();
        $builds = $buildQuery->paginate(10)->withQueryString();


        return view('tasks.analytics.builds', compact('dailyBuildsGraph', 'builds'));
    }

    public function pushes(Course $course, Task $task)
    {
        $pushes = $task->pushes()->with('project.ownable')->latest()->get();

        return view('tasks.analytics.pushes', compact('pushes'));
    }

    public function taskCompletion(Course $course, Task $task)
    {
        $projectIds = $task->projects()->pluck('id');
        $finishedProjectCount = $task->projects()->ended()->count();

        $subTasksCompleted = ProjectSubTask::whereIn('project_id', $projectIds)
            ->select(\DB::raw('sub_task_id, count(*) as count'))
            ->groupBy('sub_task_id')
            ->pluck('count', 'sub_task_id');

        $subtasks = $task->sub_tasks->all()->groupBy('group')->map(fn(Collection $subTasks, $group) => [
            'group'     => $group,
            'maxPoints' => $subTasks->sum(fn(SubTask $task) => $task->getPoints()),
            'tasks'     => $subTasks->map(function(SubTask $subTask) use ($finishedProjectCount, $subTasksCompleted) {
                $completedCount = $subTasksCompleted->has($subTask->getId()) ? $subTasksCompleted[$subTask->getId()] : 0;
                return [
                    'id'             => $subTask->getId(),
                    'isRequired'     => $subTask->isRequired(),
                    'name'           => $subTask->getDisplayName(),
                    'maxPoints'      => $subTask->getPoints(),
                    'completedCount' => $completedCount,
                    'percentage'     => round($completedCount / $finishedProjectCount * 100)
                ];
            })
        ]);

        return view('tasks.analytics.taskCompletion', compact('subtasks', 'finishedProjectCount'));
    }

    public function subTasks(Course $course, Task $task)
    {
        $subTasks = $task->sub_tasks->all()->groupBy("group")->map(fn($tasks, $group) => [
            'name' => $group,
            'editing' => false,
            'tasks' => $tasks->map(fn(SubTask $t) => [
                'id' => $t->id,
                'name' => $t->getName(),
                'editing' => false,
                'points' => $t->points
            ])
        ])->values();
        return view('tasks.analytics.subTasks', [
            'subTasks' => $subTasks
        ]);
    }

    public function saveSubTasks(Course $course, Task $task)
    {
        $subTaskCollection = new SubTaskCollection();
        collect(\request()->json())->map(fn($group) => [
            ...collect($group['tasks'])->map(fn($task) => (new SubTask($task['name'], null, $group['name']))->setPoints($task['points']))
        ])->flatten()
            ->each(fn(SubTask $subTask) => $subTaskCollection->add($subTask));
        $task->sub_tasks = $subTaskCollection;
        $task->save();

        return "OK";
    }
}
