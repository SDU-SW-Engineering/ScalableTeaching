<?php

namespace App\Http\Controllers\Task\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Task;

class GradingController extends Controller
{
    public function gradingDelegate(Course $course, Task $task)
    {
        return view('tasks.admin.grading.delegate');
    }
}
