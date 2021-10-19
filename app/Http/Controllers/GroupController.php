<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Group;
use App\Models\GroupInvitation;
use App\Models\User;
use App\Models\User as UserModel;
use Badcow\PhraseGenerator\PhraseGenerator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;

class GroupController extends Controller
{
    public function index(Course $course)
    {
        $invitations = $course->groupInvitations()
            ->with(['invitedBy', 'group.users'])
            ->where('recipient_user_id', auth()->id())->get()->each(function ($invite)
            {
                $invite->acceptRoute  = route('courses.groups.respondInvite', [$invite->group->course_id, $invite->group_id, $invite->id, 'accept']);
                $invite->declineRoute = route('courses.groups.respondInvite', [$invite->group->course_id, $invite->group_id, $invite->id, 'decline']);
            });

        $groups = $this->addMetaToUserGroups($course->userGroups(auth()->user(), true));
        return view('groups.index', [
            'canCreateGroup' => auth()->user()->can('createGroup', $course),
            'course'         => $course,
            'breadcrumbs'    => [
                'Courses'     => route('courses.index'),
                $course->name => null
            ],
            'groups'         => $groups,
            'invitations'    => $invitations
        ]);
    }

    /**
     * @throws \Throwable
     */
    public function create(Course $course)
    {
        $groupRequest = request()->validate([
            'name' => ['required', 'alpha_hyphen']
        ]);

        throw_if($course->groups()->where($groupRequest)->exists(), ValidationException::withMessages(['A group with this name already exists']));

        $group = $course->groups()->create($groupRequest);
        $group->users()->attach(auth()->id(), ['is_owner' => true]);

        return [
            'groups'          => $this->addMetaToUserGroups($course->userGroups(auth()->user(), true)),
            'canCreateGroups' => auth()->user()->can('createGroup', $course)
        ];
    }

    private function addMetaToUserGroups(Collection $groups)
    {
        return $groups->each(function (Group $group)
        {
            $group->deleteRoute = route('courses.groups.destroy', [$group->course_id, $group->id]);
            $group->inviteRoute = route('courses.groups.invite', [$group->course_id, $group->id]);
            $group->canDelete   = \Gate::inspect('delete', $group)->toArray();
            $group->canLeave    = \Gate::inspect('leave', $group)->toArray();
            return $group;
        });
    }

    public function destroy(Course $course, Group $group)
    {
        $group->users()->detach();
        $group->delete();

        return "OK";
    }

    /**
     * @throws \Throwable
     */
    public function inviteUser(Course $course, Group $group)
    {
        $validated = \request()->validate([
            'email' => ['email']
        ]);
        $foundUser = User::where('email', $validated['email'])->firstOrFail();
        throw_if($group->users->contains('id', $foundUser->id), ValidationException::withMessages(['email' => 'This user is already a member of this group.']));
        throw_if($group->invitations()->count() >= 3, ValidationException::withMessages(['email' => 'You can at max have three outstanding invitations.']));
        throw_if($group->invitations()->where('recipient_user_id', $foundUser->id)->exists(), ValidationException::withMessages(['email' => 'This user has already been invited to your group.']));

        $group->invitations()->create([
            'recipient_user_id'  => $foundUser->id,
            'invited_by_user_id' => auth()->id()
        ]);

        return "ok";
    }

    public function respondToInvite(Course $course, Group $group, GroupInvitation $groupInvitation, $mode)
    {
        $accepting = $mode == 'accept';
        if ($accepting)
            $group->users()->attach(auth()->id());
        $groupInvitation->delete();

        return "ok";
    }
}
