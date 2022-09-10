<?php

namespace App\Http\Controllers\Course\Management;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use Illuminate\View\View;

class UserManagementController extends Controller
{
    public function enrolment(Course $course) : View
    {
        $members = $course->members()->orderBy('name')->get()->map(fn(User $user) => [
            'id'          => $user->id,
            'name'        => $user->name,
            'enrolled_at' => $user->courseMembership->created_at->diffForHumans(),
            'avatar'      => $user->avatar,
            'updatable'   => $user->id != auth()->id(),
            'role'        => $user->courseMembership->role,
        ]);

        $roles = [
            'student' => 'Student',
            'teacher' => 'Teacher',
        ];

        $roleRoute = route('courses.manage.update-role', $course);
        $kickRoute = route('courses.manage.kick-user', $course);
        $activityRoute = route('courses.manage.activity.index', $course);

        return view('courses.manage.enrolled', compact('members', 'roles', 'roleRoute', 'kickRoute', 'activityRoute'));
    }

    public function updateRole(Course $course) : string
    {
        $validated = request()->validate([
            'role' => ['required', 'string'],
            'user' => ['required', 'numeric'],
        ]);

        $course->members()->updateExistingPivot($validated['user'], ['role' => $validated['role']]);

        return "ok";
    }

    public function kickUser(Course $course) : string
    {
        $validated = request()->validate([
            'user' => ['required', 'numeric'],
        ]);

        $course->members()->detach($validated['user']);

        return "ok";
    }

    public function roles(Course $course): View
    {
        return view('courses.manage.roles');
    }
}
