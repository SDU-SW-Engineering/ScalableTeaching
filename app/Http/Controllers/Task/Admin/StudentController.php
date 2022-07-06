<?php

namespace App\Http\Controllers\Task\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Task;

class StudentController extends Controller
{
    public function students(Course $course, Task $task)
    {
        return view('tasks.admin.students', compact('course', 'task'));
    }
}
