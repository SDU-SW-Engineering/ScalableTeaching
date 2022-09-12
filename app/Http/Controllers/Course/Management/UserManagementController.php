<?php

namespace App\Http\Controllers\Course\Management;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseUser;
use App\Models\Grade;
use App\Models\Group;
use App\Models\GroupInvitation;
use App\Models\GroupUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;

class UserManagementController extends Controller
{
    public function enrolment(Course $course): View
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

    public function updateRole(Course $course): string
    {
        $validated = request()->validate([
            'role' => ['required', 'string'],
            'user' => ['required', 'numeric'],
        ]);

        $course->members()->updateExistingPivot($validated['user'], ['role' => $validated['role']]);

        return "ok";
    }

    public function kickUser(Course $course): string
    {
        $validated = request()->validate([
            'user' => ['required', 'numeric'],
        ]);

        $course->members()->detach($validated['user']);

        return "ok";
    }

    public function activity(Course $course) : View
    {
        $activities = $course->activities();

        $searchFilter = request('user');
        if(is_numeric($searchFilter))
            $activities->where('affected_id', $searchFilter);
        else if(is_string($searchFilter))
            $activities->whereRelation('affected', 'name', 'like', "%$searchFilter%");

        if(filled(request('kind')))
        {
            $activities->where('resource_type', match (request('kind'))
            {
                'grade'            => Grade::class,
                'membership'       => CourseUser::class,
                'group'            => Group::class,
                'group-invitation' => GroupInvitation::class,
                'group-membership' => GroupUser::class,
                default            => null
            });
        }

        $activities = $activities->latest()->paginate(50);

        return view('courses.manage.activity', compact('course', 'activities'));
    }

    public function roles(Course $course): View
    {
        return view('courses.manage.roles');
    }
}
