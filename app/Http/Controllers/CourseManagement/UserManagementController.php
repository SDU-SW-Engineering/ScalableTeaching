<?php

namespace App\Http\Controllers\CourseManagement;

use App\Http\Controllers\Controller;
use App\Models\Course;

class UserManagementController extends Controller
{
    public function roles(Course $course)
    {
        return view('courses.manage.roles');
    }

    public function users()
    {
        return view('courses.manage.enrolled');
    }
}
