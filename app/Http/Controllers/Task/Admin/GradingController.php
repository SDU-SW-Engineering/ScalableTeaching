<?php

namespace App\Http\Controllers\Task\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseRole;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class GradingController extends Controller
{
    public function gradingDelegate(Course $course, Task $task): View
    {
        $currentlyDelegated = $task->delegations->pluck('course_role_id');
        $eligibleRoles = $course->roles->reject(function(CourseRole $role) use ($currentlyDelegated) {
            return $currentlyDelegated->contains($role->id);
        });

        return view('tasks.admin.grading.delegate', compact('eligibleRoles'));
    }

    public function addDelegation(Request $request, Course $course, Task $task): RedirectResponse
    {
        $validated = $request->validate([
            'role'             => ['required'/*Rule::in($course->roles->pluck('id')), Rule::notIn($task->delegations->pluck('course_role_id'))*/], // todo: enable when roles are better defined
            'tasks'            => ['required', 'numeric'],
            'type'             => ['required', Rule::in('last_pushes', 'succeeding_pushes', 'succeed_last_pushes')],
            'deadline_date'    => ['required', 'date'],
            'deadline_hour'    => ['required', 'date_format:H:i'],
            'options.feedback' => ['required_without::options.grading'],
        ]);
        $deadline = Carbon::parse($validated['deadline_date'] . " " . $validated['deadline_hour']);
        if($deadline->isBefore($task->ends_at))
            return back()->withInput()->withErrors('The deadline must occur after the end of the task.');

        $task->delegations()->create([
            'course_role_id'   => $validated['role'] == 'student' ? 1 : 2, // 1 = student, 2 = teahcer, todo: should reflect actual roles.
            'number_of_tasks'  => $validated['tasks'],
            'type'             => $validated['type'],
            'deadline_at'      => $deadline,
            'feedback'         => $request->has('options.feedback'),
            'grading'          => $request->has('options.grading'),
        ]);

        return redirect()->back();
    }

    public function removeDelegation(Request $request, Course $course, Task $task): RedirectResponse
    {
        $request->validate([
            'role' => ['required', Rule::in($task->delegations->pluck('id'))],
        ]);

        $task->delegations()->where('id', $request->get('role'))->delete();

        return redirect()->back();
    }
}
