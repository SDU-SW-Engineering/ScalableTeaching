<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function show(Course $course, Task $task)
    {
        $user        = User::firstWhere(['guid' => auth()->id()]);
        $project     = $task->projects()->firstWhere('ownable_id', $user->id);
        $startDay    = $task->starts_at->format("j/n");
        $endDay      = $task->ends_at->format("j/n");
        $percent     = number_format(now()->diffInSeconds($task->starts_at) / $task->starts_at->diffInSeconds($task->ends_at) * 100, 2);
        $progress    = $percent > 100 ? 100 : $percent;
        $timeLeft    = $task->ends_at->isPast() ? '' : str_replace('from now', 'left', $task->ends_at->diffForHumans());
        $dailyBuilds = $task->dailyBuilds();
        $myBuilds    = $task->dailyBuilds($user->id);

        return view('tasks.show', [
            'course'   => $course,
            'task'     => $task,
            'bg'       => 'bg-gray-50 dark:bg-gray-600',
            'project'  => $project,
            'progress' => [
                'startDay' => $startDay,
                'endDay'   => $endDay,
                'percent'  => $progress,
                'timeLeft' => $timeLeft
            ],
            'builds'   => $dailyBuilds,
            'myBuilds' => $myBuilds
        ]);
    }
}
