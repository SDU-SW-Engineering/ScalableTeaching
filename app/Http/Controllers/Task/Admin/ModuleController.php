<?php

namespace App\Http\Controllers\Task\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Task;

class ModuleController extends Controller
{
    public function index(Course $course, Task $task)
    {
        return view('tasks.admin.modules.index');
    }
}
