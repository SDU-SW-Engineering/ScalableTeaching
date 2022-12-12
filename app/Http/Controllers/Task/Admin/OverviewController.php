<?php

namespace App\Http\Controllers\Task\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Task;
use Domain\Analytics\Graph\DataSets\BarDataSet;
use Domain\Analytics\Graph\DataSets\LineDataSet;
use Domain\Analytics\Graph\Graph;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class OverviewController extends Controller
{
    public function index(Course $course, Task $task) : View
    {
        $projectCount = $task->projects()->count();
        $projectsToday = $task->projects()->whereRaw('date(created_at) = ?', now()->toDateString())->count();
        $finishedCount = $task->projects()->where('status', 'finished')->count();
        $finishedPercent = $projectCount == 0 ? 0 : $finishedCount / $projectCount * 100;
        $failedCount = $task->projects()->where('status', 'failed')->count();
        $failedPercent = $projectCount == 0 ? 0 : $failedCount / $projectCount * 100;
        $buildCount = $task->jobs()->count();
        $buildsToday = $task->jobs()->whereRaw('date(pipelines.created_at) = ?', now()->toDateString())->withTrashedParents()->count();
        $visitorCount = $task->visitors()->whereRaw('task_id = ?', $task->id)->count();
        $visitorsToday = $task->visitors()->whereRaw('date(created_at) = ? and task_id = ?', [now()->toDateString(), $task->id])->count();

        $projectQuery = $task->projects()
            ->select('*', \DB::raw('TIMESTAMPDIFF(second,created_at, finished_at) as duration'))
            ->withCount('pipelines')
            ->orderBy(request('sort', 'created_at'), request('direction', 'desc'));

        if(request('status', 'all') != 'all')
            $projectQuery->where('status', request('status', 'active'));

        $projects = $projectQuery->paginate(10)->withQueryString();

        /** @var Collection<string,int> $totalProjectsPerDay */
        $totalProjectsPerDay = $task->totalProjectsPerDay;
        /** @var Collection<string,int> $projectsCompletedPerDay */
        $projectsCompletedPerDay = $task->totalCompletedTasksPerDay;
        $totalProjectsPerDayGraph = $totalProjectsPerDay == null ? null : new Graph(
            $totalProjectsPerDay->keys(),
            new LineDataSet("Projects", $totalProjectsPerDay->values(), "#266ab0", true),
            new LineDataSet("Completed", $projectsCompletedPerDay->values(), "#7BB026", true)
        );

        /** @var Collection<string,int> $totalVisitsPerDay */
        $totalVisitsPerDay = $task->totalVisitsPerDay;
        $totalVisitsPerDayGraph = $totalVisitsPerDay == null ? null : new Graph(
            $totalVisitsPerDay->keys(),
            new LineDataSet("Visits", $totalVisitsPerDay->values(), "#266ab0", true)
        );

        /** @var Collection<string,int> $dailyBuilds */
        $dailyBuilds = $task->dailyBuilds(true, true);
        $dailyBuildsGraph = $dailyBuilds == null ? null : new Graph($dailyBuilds->keys(), new BarDataSet("Builds", $dailyBuilds->values(), "#4F535B"));

        if ($task->type == 'assignment')
        {
            return view('tasks.admin.index', compact(
                'course',
                'task',
                'projectCount',
                'projectsToday',
                'finishedCount',
                'finishedPercent',
                'failedCount',
                'failedPercent',
                'buildCount',
                'buildsToday',
                'totalProjectsPerDayGraph',
                'dailyBuildsGraph',
                'projects'
            ));
        }

        return view('tasks.admin.indexExercise', compact(
            'course',
            'task',
            'projectCount',
            'projectsToday',
            'finishedCount',
            'finishedPercent',
            'failedCount',
            'failedPercent',
            'buildCount',
            'buildsToday',
            'totalProjectsPerDayGraph',
            'dailyBuildsGraph',
            'projects',
            'visitorCount',
            'visitorsToday',
            'totalVisitsPerDayGraph'
        ));
    }
}
