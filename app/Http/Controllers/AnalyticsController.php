<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Project;
use App\Models\Task;
use Domain\Analytics\Graph\DataSets\BarDataSet;
use Domain\Analytics\Graph\DataSets\LineDataSet;
use Domain\Analytics\Graph\Graph;
use GraphQL\Client;
use GraphQL\SchemaObject\RootProjectsArgumentsObject;
use GraphQL\SchemaObject\RootQueryObject;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{

    public function index(Course $course, Task $task)
    {
        $projectCount    = $task->projects()->count();
        $projectsToday   = $task->projects()->whereRaw('date(created_at) = ?', now()->toDateString())->count();
        $finishedCount   = $task->projects()->where('status', 'finished')->count();
        $finishedPercent = $finishedCount / $projectCount * 100;
        $failedCount     = $task->projects()->where('status', 'failed')->count();
        $failedPercent   = $failedCount / $projectCount * 100;
        $buildCount      = $task->jobs()->count();
        $buildsToday     = $task->jobs()->whereRaw("date(job_statuses.created_at) = ?", now()->toDateString())->withTrashedParents()->count();

        $projectQuery = $task->projects()
            ->select('*', \DB::raw('TIMESTAMPDIFF(second,created_at, finished_at) as duration'))
            ->withCount('jobStatuses')
            ->orderBy(request('sort', 'created_at'), request('direction', 'desc'));

        if (request('status', 'all') != 'all')
            $projectQuery->where('status', request('status', 'active'));

        $projects = $projectQuery->paginate(10)->withQueryString();

        $totalProjectsPerDay      = $task->totalProjectsPerDay;
        $projectsCompletedPerDay  = $task->totalCompletedTasksPerDay;
        $totalProjectsPerDayGraph = new Graph($totalProjectsPerDay->keys(),
            new LineDataSet("Projects", $totalProjectsPerDay, "#266ab0", true),
            new LineDataSet("Completed", $projectsCompletedPerDay, "#7BB026", true)
        );

        $dailyBuilds      = $task->dailyBuilds(true, true);
        $dailyBuildsGraph = new Graph($dailyBuilds->keys(), new BarDataSet("Builds", $dailyBuilds, "#4F535B"));
        $breadcrumbs      = [
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
        $dailyBuilds      = $task->dailyBuilds(true, true);
        $activeIndex      = $dailyBuilds->keys()->search(\request('q'));
        $dailyBuildsGraph = new Graph($dailyBuilds->keys(), new BarDataSet("Builds", $dailyBuilds, "#4F535B", $activeIndex === false ? null : $activeIndex));

        $buildQuery = $task->jobs();


        if (\request('q') != null)
            $buildQuery->whereRaw('date(job_statuses.created_at) = ?', \request('q'));

        if (\request('status') != null)
            $buildQuery->where('job_statuses.status', \request('status'));

        $buildQuery->latest();
        $builds = $buildQuery->paginate(10)->withQueryString();

        $breadcrumbs = [
            'Courses'     => route('courses.index'),
            $course->name => route('courses.show', $course->id),
            $task->name   => route('courses.tasks.show', [$course->id, $task->id]),
            'Analytics'   => route('courses.tasks.analytics.index', [$course->id, $task->id]),
            'Builds'      => null
        ];

        return view('tasks.analytics.builds', compact('breadcrumbs', 'dailyBuildsGraph', 'course', 'task', 'builds'));
    }
}
