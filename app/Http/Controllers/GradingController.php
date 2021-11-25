<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class GradingController extends Controller
{
    public function index(Course $course)
    {
        $taskGrades = $course->tasks->mapWithKeys(fn(Task $task) => [$task->id => $task->grades()]);
        $grades     = $course->students->map(function (User $student) use ($taskGrades, $course)
        {
            return [
                'student' => [
                    'id'   => $student->id,
                    'name' => $student->name
                ],
                'tasks'   => $course->tasks->map(fn(Task $task) => [
                    'task'  => [
                        'id'   => $task->id,
                        'name' => $task->name
                    ],
                    'grade' => $taskGrades[$task->id]->has($student->id)
                        ? $taskGrades[$task->id][$student->id]
                        : null
                ])
            ];
        })->sortBy('student.name');

        return view('courses.grading.index', ['grades' => $grades, 'course' => $course]);
    }
}
