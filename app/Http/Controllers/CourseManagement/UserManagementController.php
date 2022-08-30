<?php

namespace App\Http\Controllers\CourseManagement;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\View\View;

class UserManagementController extends Controller
{
    public function roles(Course $course) : View
    {
        return view('courses.manage.roles');
    }

    public function users() : View
    {
        return view('courses.manage.enrolled');
    }
}
