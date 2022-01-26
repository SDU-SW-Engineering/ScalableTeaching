<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Grade;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class GradingController extends Controller
{
    public function index(Course $course)
    {
        $taskGrades = $course->tasks()->with('grades')->get()->keyBy('id');

        $grades = $course->students->map(function(User $student) use ($taskGrades, $course) {
            return [
                'student' => [
                    'id'   => $student->id,
                    'name' => $student->name
                ],
                'tasks'   => $course->tasks->map(fn(Task $task) => [
                    'history'        => false,
                    'historyEntries' => null,
                    'adding'         => false,
                    'saving'         => false,
                    'task'           => [
                        'id'   => $task->id,
                        'name' => $task->name
                    ],
                    'grade'          => $taskGrades[$task->id]->grades->where('user_id', $student->id)->firstWhere('selected', true)?->toArray()
                ]),
            ];
        })->sortBy('student.name');

        return view('courses.grading.index', ['grades' => $grades, 'course' => $course]);
    }

    public function updateGrading(Course $course, User $user)
    {
        abort_unless($course->students->contains('id', $user->id), 400);


        $user->grades()->create([
            'task_id'     => \request('taskId'),
            'value'       => \App\Models\Enums\Grade::from(request('grade')),
            'source_type' => User::class,
            'source_id'   => auth()->id(),
            'selected'    => true
        ]);
        $user->grades()->firstOrCreate();
    }

    public function taskInfo(Course $course, Task $task)
    {
        return $task->grades()->where([
            'user_id' => \request('user')
        ])->orderByDesc('created_at')->get();
    }

    public function setSelected(Course $course, Grade $grade)
    {
        $grade->select();

        return "ok";
    }
}
