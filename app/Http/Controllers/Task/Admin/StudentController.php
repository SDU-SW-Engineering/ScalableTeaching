<?php

namespace App\Http\Controllers\Task\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Task;
use Illuminate\View\View;

class StudentController extends Controller
{
    public function students(Course $course, Task $task): View
    {
        return view('tasks.admin.students', compact('course', 'task'));
    }


}
