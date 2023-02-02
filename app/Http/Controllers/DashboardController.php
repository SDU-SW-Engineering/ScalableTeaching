<?php

namespace App\Http\Controllers;

use App\Models\Pipeline;
use App\Models\Project;
use App\Models\Task;
use Auth;
use Cache;
use Illuminate\View\View;

class DashboardController extends Controller
{
    private function nonAuthIndex(): view
    {
        $averageQueueTime = Cache::remember('queue1MonthAvg', 3600, function () {
            return Pipeline::where('created_at', '>=', now()->subMonth()->toDateString())
                ->average('queue_duration');
        });

        $builds = Cache::remember('build1MonthCount', 3600, function () {
            return Pipeline::where('created_at', '>=', now()->subMonth()->toDateString())->count();
        });

        $buildAverageTime = Cache::remember('build1MonthAvg', 3600, function () {
            return Pipeline::where('created_at', '>=', now()->subMonth()->toDateString())
                ->average('duration');
        });

        $projectCount = Cache::remember('projectCount', 3600, function () {
            return Project::count();
        });

        $assignmentCount = Cache::remember('assignmentCount', 3600, function () {
            return Task::count();
        });

        return view('home', [
            'hideHeader' => true,
            'avgQueue' => $averageQueueTime,
            'buildCount' => $builds,
            'buildAvg' => $buildAverageTime,
            'projectCount' => $projectCount,
            'assignmentCount' => $assignmentCount,
        ]);
    }

    public function authIndex(): view
    {
        $awaitingFeedback = auth()->user()->feedback()->with(['taskDelegation', 'project.task.course'])->get();
        $courses = auth()->user()->courses()->orderBy('created_at', 'desc')->get();
        $tasks = Task::whereIn('course_id', $courses->pluck('id'))->where('ends_at', '>=', now())->assignments()->orderBy('ends_at', 'asc')->visible()->get();
        $nextAssignment = $tasks->first();
        $courseAssignments = Task::assignments()->whereIn('course_id', $courses->pluck('id'))->get();
        $exercises = Task::exercises()->whereIn('course_id', $courses->pluck('id'))->orderBy('created_at', 'desc')->take(5)->visible()->get();

        return view('dashboard', [
            'courses' => $courses,
            'tasks' => $tasks,
            'exercises' => $exercises,
            'courseAssignments' => $courseAssignments,
            'nextAssignment' => $nextAssignment,
            'bg' => 'bg-gray-100 dark:bg-gray-700',
            'awaitingFeedback' => $awaitingFeedback,
        ]);
    }

    public function index(): view
    {
        if (Auth::check()) {
            return $this->authIndex();
        }

        return $this->nonAuthIndex();
    }
}
