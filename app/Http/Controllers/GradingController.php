<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\OverrideGrade;
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
                        : [
                            'grade' => 'unbegun',
                            'originalGrade' => 'unbegun'
                        ]
                ])
            ];
        })->sortBy('student.name');

        return view('courses.grading.index', ['grades' => $grades, 'course' => $course]);
    }

    public function updateGrading(Course $course, User $user)
    {
        abort_unless($course->students->contains('id', $user->id), 400);
        $actualGrades = $course->tasks->mapWithKeys(fn(Task $task) => [$task->id =>  $task->grades([$user])->first()['grade']]);
        $override = \request()->all();
        $changes = collect($override)->intersectByKeys($actualGrades)->filter(fn($status, $key) => $actualGrades[$key] != $status);
        //OverrideGrade::whereIn('task_id',)
        OverrideGrade::whereIn('task_id', $actualGrades->diffKeys($override)->keys())->where('user_id', $user->id)->delete();
        foreach($changes as $taskId => $change) {
            OverrideGrade::updateOrCreate([
                'task_id' => $taskId,
                'user_id' => $user->id,
            ], [
                'overridden_by' => auth()->id(),
                'status' => $change
            ]);
        }
    }
}
