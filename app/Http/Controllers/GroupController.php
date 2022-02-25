<?php

namespace App\Http\Controllers;

use App\Http\Resources\Groups\GroupCollection;
use App\Models\Course;
use App\Models\Group;
use App\Models\GroupInvitation;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;

class GroupController extends Controller
{
    public function index(Course $course)
    {
        $invitations = $course->groupInvitations()
            ->with(['invitedBy', 'group.users'])
            ->where('recipient_user_id', auth()->id())->get()->map(fn (GroupInvitation $invite) =>[
                'acceptRoute' => route('courses.groups.respondInvite', [$invite->group->course_id, $invite->group_id, $invite->id, 'accept']),
                'declineRoute' => route('courses.groups.respondInvite', [$invite->group->course_id, $invite->group_id, $invite->id, 'decline']),
                'canAccept' =>     \Gate::inspect('canAcceptInvite', [$invite->group, $invite])->toArray()
            ]);

        //$groups = $this->groupResponse($course->userGroups(auth()->user()));

        return  [
            'canCreateGroup' => \Gate::inspect('createGroup', $course)->toArray(),
            'course'         => $course,
            'breadcrumbs'    => [
                'Courses'     => route('courses.index'),
                $course->name => null
            ],
            'groups'         => GroupCollection::collection($course->userGroups(auth()->user())),
            'invitations'    => $invitations
        ];
        return view('groups.index', [
            'canCreateGroup' => \Gate::inspect('createGroup', $course)->toArray(),
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

        return response([
            'groups'          => $this->groupResponse($course->userGroups(auth()->user())),
            'canCreateGroups' => auth()->user()->can('createGroup', $course)
        ], 201);
    }

    private function groupResponse(Collection $groups)
    {
        return $groups->map(fn (Group $group) => [
            'memberCap' => $group->course->max_group_size,
            'invitations' => $group->invitations->map(fn(GroupInvitation $invitation) => [
                'deleteRoute' => route('courses.groups.invitations.delete', [$group->course_id, $group->id, $invitation->id])
            ]),
            'users' => $group->users->each(fn(User $member) => [
                'isYou' =>  $member->id == auth()->id(),
                'removeUserRoute' => route('courses.groups.removeMember', [$group->course_id, $group->id, $member->id]),
            ]),
            'deleteRoute' =>  route('courses.groups.destroy', [$group->course_id, $group->id]),
            'inviteRoute' => route('courses.groups.invite', [$group->course_id, $group->id]),
            'leaveRoute' => route('courses.groups.leave', [$group->course_id, $group->id]),
            'canDelete' => \Gate::inspect('delete', $group)->toArray(),
            'canLeave' => \Gate::inspect('leave', $group)->toArray(),
            'isOwner' => $group->users()->where('user_id', auth()->id())->wherePivot('is_owner', true)->exists()
        ]);
    }

    public function destroy(Course $course, Group $group)
    {
        $group->users()->detach();
        $group->invitations()->delete();
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
        throw_unless($course->hasUser($foundUser), ValidationException::withMessages(['email' => 'This user is not a member of this course.']));
        throw_if($group->users->contains('id', $foundUser->id), ValidationException::withMessages(['email' => 'This user is already a member of this group.']));
        throw_if($group->invitations()->count() >= $group->course->max_group_size - $group->users()->count(), ValidationException::withMessages(['email' => "There is no more room in your group."]));
        throw_if($group->invitations()->where('recipient_user_id', $foundUser->id)->exists(), ValidationException::withMessages(['email' => 'This user has already been invited to your group.']));

        $invitation = $group->invitations()->create([
            'recipient_user_id'  => $foundUser->id,
            'invited_by_user_id' => auth()->id()
        ]);

        $invitation->load('recipient');

        return [
            'invitation' => $invitation,
            'deleteRoute' => route('courses.groups.invitations.delete', [$group->course_id, $group->id, $invitation->id])
        ];
    }

    public function respondToInvite(Course $course, Group $group, GroupInvitation $groupInvitation, $mode)
    {
        $accepting = $mode == 'accept';
        if ($accepting)
        {
            if (auth()->user()->cannot('canAcceptInvite', [$group, $groupInvitation]))
                return response("failed", 422);

            $group->users()->attach(auth()->id());
        }
        $groupInvitation->delete();

        return "ok";
    }

    public function leave(Course $course, Group $group)
    {
        $group->users()->detach(auth()->id());

        return "ok";
    }

    public function deleteInvite(Course $course, Group $group, GroupInvitation $groupInvitation)
    {
        $groupInvitation->delete();

        return "ok";
    }

    public function removeMember(Course $course, Group $group, User $user)
    {
        $group->users()->detach($user);

        return [
            'group_id'  => $group->id,
            'canDelete' => \Gate::inspect('delete', $group)->toArray()
        ];
    }
}
