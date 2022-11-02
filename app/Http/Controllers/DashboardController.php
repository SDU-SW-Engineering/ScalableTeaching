<?php

namespace App\Http\Controllers;

use App\Models\ProjectFeedback;
use App\Models\Task;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $awaitingFeedback = auth()->user()->feedback()->with(['taskDelegation', 'project.task.course'])->unreviewed()->get()
            ->filter(fn (ProjectFeedback $feedback) => $feedback->taskDelegation->deadline_at->isFuture());
        $courses = auth()->user()->courses()->get();
        $tasks = Task::whereIn('course_id', $courses->pluck('id'))->where('ends_at', '>=', now())->assignments()->orderBy('ends_at', 'asc')->visible()->get();
        $nextAssignment = $tasks->first();
        $courseAssignments = Task::assignments()->whereIn('course_id', $courses->pluck('id'))->get();
        $exercises = Task::exercises()->whereIn('course_id', $courses->pluck('id'))->orderBy('starts_at', 'asc')->take(5)->visible()->get();

        return view('dashboard', [
            'courses' => $courses,
            'tasks' => $tasks,
            'exercises' => $exercises,
            'courseAssignments' => $courseAssignments,
            'nextAssignment' => $nextAssignment,
            'bg' => 'bg-gray-100 dark:bg-gray-700',
            'awaitingFeedback' => $awaitingFeedback,
            'breadcrumbs' => [
                'Dashboard' => null,
            ],
        ]);
    }
}
