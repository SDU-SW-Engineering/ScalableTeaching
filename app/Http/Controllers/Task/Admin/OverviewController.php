<?php

namespace App\Http\Controllers\Task\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Task;
use Domain\Analytics\Graph\DataSets\BarDataSet;
use Domain\Analytics\Graph\DataSets\LineDataSet;
use Domain\Analytics\Graph\Graph;

class OverviewController extends Controller
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


        return view('tasks.admin.index', compact('course', 'task', 'projectCount',
            'projectsToday', 'finishedCount', 'finishedPercent', 'failedCount', 'failedPercent', 'buildCount', 'buildsToday',
            'totalProjectsPerDayGraph', 'dailyBuildsGraph', 'projects'));
    }
}
