<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enums\TaskTypeEnum;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Task;
use App\Models\User;

class DashboardController extends Controller
{
    public function index() : View
    {
        $courses = auth()->user()->courses->map(function($course) {

            $tasks = $course->tasks->map(function(Task $task) {
                $project = $task->currentProjectForUser(auth()->user());

                return [
                    'task'    => $task,
                    'project' => $project,
                    'status'  => $project?->status,
                ];
            });

            $deadline = $tasks->sort(function($a, $b) {
                $startsAtA = Carbon::parse($a['task']->starts_at);
                $endsAtA = Carbon::parse($a['task']->ends_at);
                $startsAtB = Carbon::parse($b['task']->starts_at);
                $endsAtB = Carbon::parse($b['task']->ends_at);

                if(now()->between($startsAtA, $endsAtA))
                    return -1;
                if(now()->between($startsAtB, $endsAtB))
                    return 1;

                if($endsAtA->isPast() || $endsAtB->isPast())
                    return 1;

                return now()->diffInSeconds($endsAtA) > now()->diffInSeconds($endsAtB) ? 1 : -1;
            })->first();

            return [
                'id'            => $course->id,
                'name'          => $course->name,
                //'taskName'      => $course->$tasks->name,
                'taskCount'     => $tasks->count(),
                'completed'     => $tasks->where('status', 'finished')->count(),
                'next_deadline' => $deadline != null ? $deadline['task']->ends_at : null,
            ];
        });

        return view('dashboard', [
            'courses'     => $courses,
            'bg'          => 'bg-gray-100 dark:bg-gray-700',
            'breadcrumbs' => [
                'Dashboard' => null,
            ],
        ]);
    }

    public function show(Course $course) : View
    {
        $tasks = $course->tasks()->whereNull('track_id')->where('is_visible', true)->get()->map(fn(Task $task) => [
            'details' => $task,
            'project' => $task->currentProjectForUser(auth()->user()),
        ]);

        $exerciseGroups = $tasks->filter(fn($task) => $task['details']->type == TaskTypeEnum::Exercise)->groupBy(fn($task) => $task['details']->grouped_by);
        $assignments = $tasks->filter(fn($task) => $task['details']->type == TaskTypeEnum::Assignment);

        $taskCount = $course->tasks()->count();

        return view('dashboard.show', [
            'course'         => $course,
            'bg'             => 'bg-gray-50 dark:bg-gray-600',
            'taskCount'      => $taskCount,
            'exerciseGroups' => $exerciseGroups,
            'assignments'    => $assignments,
        ]);
    }
}
