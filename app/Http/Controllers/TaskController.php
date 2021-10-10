<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function show(Course $course, Task $task)
    {
        return view('tasks.show', [
            'course' => $course,
            'task'   => $task,
            'bg'     => 'bg-gray-50 dark:bg-gray-600'
        ]);
    }
}
