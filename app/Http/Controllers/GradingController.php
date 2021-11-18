<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class GradingController extends Controller
{
    public function index(Course $course)
    {
        return view('courses.grading.index', ['course' => $course]);
    }
}
