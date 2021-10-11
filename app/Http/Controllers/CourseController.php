<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return view('courses.index', [
            'courses' => $courses,
            'bg' => 'bg-gray-50 dark:bg-gray-700'
        ]);
    }

    public function show(Course $course)
    {
        $course->load('tasks');
        return view('courses.show', [
            'course' => $course,
            'bg'     => 'bg-gray-50 dark:bg-gray-600'
        ]);
    }
}
