<?php

namespace App\Http\Controllers;

use App\Http\Resources\Groups\GroupInformation;
use App\Models\Course;
use App\Models\Group;
use App\Models\GroupInvitation;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GroupController extends Controller
{
    public function index(Request $request, Course $course) : View
    {
        $invitations = $course->groupInvitations()
            ->with(['invitedBy', 'group.members'])
            ->where('recipient_user_id', auth()->id())->get()->map(fn(GroupInvitation $invite) => [
                'acceptRoute'  => route('courses.groups.respondInvite', [$invite->group->course_id, $invite->group_id, $invite->id, 'accept']),
                'declineRoute' => route('courses.groups.respondInvite', [$invite->group->course_id, $invite->group_id, $invite->id, 'decline']),
                'canAccept'    => \Gate::inspect('canAcceptInvite', [$invite->group, $invite])->toArray(),
            ]);

        return view('groups.index', [
            'canCreateGroup' => \Gate::inspect('createGroup', $course)->toArray(),
            'course'         => $course,
            'breadcrumbs'    => [
                'Courses'     => route('courses.index'),
                $course->name => null,
            ],
            'groups'         => GroupInformation::collection($course->userGroups(auth()->user())),
            'invitations'    => $invitations,
        ]);
    }

    /**
     * @throws \Throwable
     */
    public function create(Course $course) : Response
    {
        $groupRequest = request()->validate([
            'name' => ['required', 'alpha_hyphen'],
        ]);

        throw_if($course->groups()->where($groupRequest)->exists(), ValidationException::withMessages(['A group with this name already exists']));

        $group = $course->groups()->create($groupRequest);
        $group->members()->attach(auth()->id(), ['is_owner' => true]);

        return response([
            'groups'          => GroupInformation::collection($course->userGroups(auth()->user())),
            'canCreateGroups' => auth()->user()->can('createGroup', $course),
        ], 201);
    }

    public function destroy(Course $course, Group $group) : string
    {
        $group->members()->detach();
        $group->invitations()->delete();
        $group->delete();

        return "OK";
    }

    /**
     * @throws \Throwable
     */
    public function inviteUser(Course $course, Group $group) : Response
    {
        $validated = \request()->validate([
            'email' => ['email'],
        ]);
        $foundUser = User::where('email', $validated['email'])->firstOrFail();
        throw_unless($course->hasMember($foundUser), ValidationException::withMessages(['email' => 'This user is not a member of this course.']));
        throw_if($group->members->contains('id', $foundUser->id), ValidationException::withMessages(['email' => 'This user is already a member of this group.']));
        throw_if($group->invitations()->count() >= $group->course->max_group_size - $group->members()->count(), ValidationException::withMessages(['email' => "There is no more room in your group."]));
        throw_if($group->invitations()->where('recipient_user_id', $foundUser->id)->exists(), ValidationException::withMessages(['email' => 'This user has already been invited to your group.']));

        $invitation = $group->invitations()->create([
            'recipient_user_id'  => $foundUser->id,
            'invited_by_user_id' => auth()->id(),
        ]);

        $invitation->load('recipient');

        return response([
            'invitation'  => $invitation,
            'deleteRoute' => route('courses.groups.invitations.delete', [$group->course_id, $group->id, $invitation->id]),
        ], 201);
    }

    public function respondToInvite(Course $course, Group $group, GroupInvitation $groupInvitation, string $mode) : string | Response
    {
        $accepting = $mode == 'accept';
        if ($accepting)
        {
            if (auth()->user()->cannot('acceptInvite', [$group, $groupInvitation]))
                return response("failed", 422);

            $group->members()->attach(auth()->id());
        }
        $groupInvitation->delete();

        return "ok";
    }

    public function leave(Course $course, Group $group) : string
    {
        $group->members()->detach(auth()->id());

        return "ok";
    }

    public function deleteInvite(Course $course, Group $group, GroupInvitation $groupInvitation) : string
    {
        $groupInvitation->delete();

        return "ok";
    }

    /**
     * @param Course $course
     * @param Group $group
     * @param User $user
     * @return array{group_id:int,canDelete:array}
     */
    public function removeMember(Course $course, Group $group, User $user) : array
    {
        $group->members()->detach($user);

        return [
            'group_id'  => $group->id,
            'canDelete' => \Gate::inspect('delete', $group)->toArray(),
        ];
    }
}
