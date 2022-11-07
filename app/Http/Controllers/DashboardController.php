<?php

namespace App\Http\Controllers;

use App\Models\Casts\SubTask;
use App\Models\Course;
use App\Models\Enums\CorrectionType;
use App\Models\Enums\TaskTypeEnum;
use App\Models\Grade;
use App\Models\Pipeline;
use App\Models\Project;
use App\Models\ProjectFeedback;
use Cache;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Task;
use App\Models\User;

class DashboardController extends Controller
{
    public function index(): View
    {
        if (\Auth::user() == null)
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
                'hideHeader'      => true,
                'avgQueue'        => $averageQueueTime,
                'buildCount'      => $builds,
                'buildAvg'        => $buildAverageTime,
                'projectCount'    => $projectCount,
                'assignmentCount' => $assignmentCount,
            ]);
        }
        $awaitingFeedback = auth()->user()->feedback()->with(['taskDelegation', 'project.task.course'])->unreviewed()->get()
            ->filter(fn(ProjectFeedback $feedback) => $feedback->taskDelegation->deadline_at->isFuture());
        $courses = auth()->user()->courses()->get();
        $tasks = Task::whereIn('course_id', $courses->pluck('id'))->where('ends_at', '>=', now())->assignments()->orderBy('ends_at', 'asc')->visible()->get();
        $nextAssignment = $tasks->first();
        $courseAssignments = Task::assignments()->whereIn('course_id', $courses->pluck('id'))->get();
        $exercises = Task::exercises()->whereIn('course_id', $courses->pluck('id'))->orderBy('starts_at', 'asc')->take(5)->visible()->get();

        return view('dashboard', [
            'courses'           => $courses,
            'tasks'             => $tasks,
            'exercises'         => $exercises,
            'courseAssignments' => $courseAssignments,
            'nextAssignment'    => $nextAssignment,
            'bg'                => 'bg-gray-100 dark:bg-gray-700',
            'awaitingFeedback'  => $awaitingFeedback,
        ]);

    }
}
