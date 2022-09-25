<?php

namespace App\Http\Controllers\Task\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseRole;
use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class GradingController extends Controller
{
    public function gradingDelegate(Course $course, Task $task) : View
    {
        $currentlyDelegated = $task->delegations->pluck('course_role_id');
        $eligibleRoles = $course->roles->reject(function(CourseRole $role) use ($currentlyDelegated) {
            return $currentlyDelegated->contains($role->id);
        });

        return view('tasks.admin.grading.delegate', compact('eligibleRoles'));
    }

    public function addDelegation(Request $request, Course $course, Task $task) : RedirectResponse
    {
        $request->validate([
            'role'  => ['required', /*Rule::in($course->roles->pluck('id')), Rule::notIn($task->delegations->pluck('course_role_id'))*/], // todo: enable when roles are better defined
            'tasks' => ['required', 'numeric'],
        ]);

        $task->delegations()->create([
            'course_role_id'  => $request->get('role') == 'student' ? 1 : 2, // 1 = student, 2 = teahcer, todo: should reflect actual roles.
            'number_of_tasks' => $request->get('tasks'),
        ]);

        return redirect()->back();
    }

    public function removeDelegation(Request $request, Course $course, Task $task) : RedirectResponse
    {
        $request->validate([
            'role'  => ['required', Rule::in($task->delegations->pluck('id'))],
        ]);

        $task->delegations()->where('id', $request->get('role') )->delete();

        return redirect()->back();
    }
}
