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
use Illuminate\Support\ViewErrorBag;
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

    public function activity(Course $course): View
    {
        $activities = $course->activities();

        $searchFilter = request('user');
        if(is_numeric($searchFilter))
            $activities->where('affected_id', $searchFilter);
        else if(is_string($searchFilter))
            $activities->whereRelation('affected', 'name', 'like', "%$searchFilter%");

        if(filled(request('kind'))) {
            $activities->where('resource_type', match (request('kind')) {
                'grade' => Grade::class,
                'membership' => CourseUser::class,
                'group' => Group::class,
                'group-invitation' => GroupInvitation::class,
                'group-membership' => GroupUser::class,
                default => null
            });
        }

        $activities = $activities->latest()->paginate(50);

        return view('courses.manage.activity', compact('course', 'activities'));
    }

    public function groups(Course $course)
    {
        $groups = $course->groups()->withCount('members')->withCount('projects')->orderBy('name')->paginate(30);

        return view('courses.manage.groups', compact('course', 'groups'));
    }

    public function showGroup(Course $course, Group $group)
    {
        return view('courses.manage.group', compact('course', 'group'));
    }

    public function createGroup(Course $course)
    {
        $validated = request()->validate([
            'name' => 'required'
        ]);

        $group = $course->groups()->create([
            'name' => $validated['name']
        ]);

        return redirect()->route('courses.manage.groups.show', [$course, $group])->with('success', 'Group created');
    }

    public function deleteGroup(Course $course, Group $group)
    {
        $group->delete();

        return redirect()->route('courses.manage.groups.index', $course)->with('success', 'Group deleted');
    }

    public function addGroupMember(Course $course, Group $group)
    {
        $validated = request()->validate([
            'user' => 'required|numeric'
        ]);
        $user = User::find($validated['user']);

        $userIsPartOfCourse = $course->members()->where('users.id', $user->id)->exists();
        if(!$userIsPartOfCourse)
            return redirect()->route('courses.manage.groups.show', [$course, $group])->withErrors(['name' => 'User is not part of the course']);

        $group->members()->attach($validated['user']);

        return redirect()->route('courses.manage.groups.show', [$course, $group])->with('success', $user->name . " added");
    }

    public function removeGroupMember(Course $course, Group $group)
    {
        $validated = request()->validate([
            'user' => 'required|numeric'
        ]);

        $user = $group->members()->where('users.id', $validated['user'])->first();
        if($user == null)
            return redirect()->route('courses.manage.groups.show', [$course, $group])->with('success', "User removed");

        $group->members()->detach($validated['user']);

        return redirect()->route('courses.manage.groups.show', [$course, $group])->with('success', "User removed");
    }

    public function updateGroup(Course $course, Group $group)
    {
        $validated = request()->validate([
            'name' => 'required'
        ]);

        $group->update([
            'name' => $validated['name']
        ]);

        return redirect()->route('courses.manage.groups.show', [$course, $group])->with('success', "Group renamed");
    }

    public function updateGroupSettings(Course $course)
    {
        $validated = request()->validate([
            'max-group-size'    => ['required_without:max-groups', 'nullable', 'numeric'],
            'max-groups'        => ['required_without:max-group-size'],
            'max-groups-amount' => ['required_if:max-groups,custom']
        ]);

        if(array_key_exists('max-group-size', $validated)) {
            $course->update(['max_group_size' => $validated['max-group-size']]);

            return redirect()->route('courses.manage.groups.index', [$course])->with('success', "Max group size set to " . $validated['max-group-size']);
        }

        $course->update([
            'max_groups'        => $validated['max-groups'],
            'max_groups_amount' => array_key_exists('max-groups-amount', $validated) ? $validated['max-groups-amount'] : null
        ]);

        return redirect()->route('courses.manage.groups.index', [$course])->with('success', match ($validated['max-groups']) {
            'same_as_assignments' => 'Each student can now be part of one group per assignment',
            'custom' => "Each student can now be part of {$validated['max-groups-amount']} group(s)",
            'none' => "Students can no longer form groups"
        });
    }

    public function roles(Course $course): View
    {
        return view('courses.manage.roles');
    }
}
