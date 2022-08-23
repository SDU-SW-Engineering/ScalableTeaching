<?php

namespace App\Http\Resources\Groups;

use App\Models\Group;
use App\Models\GroupInvitation;
use App\Models\User;
use Gate;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class GroupInformation extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request)
    {
        /** @var Group $group */
        $group = $this->resource;
        $course = $group->course;
        $projects = $group->projects;

        return [
            'id'          => $group->id,
            'name'        => $group->name,
            'memberCap'   => $course->max_group_size,
            'invitations' => $group->invitations->map(fn(GroupInvitation $invitation) => [
                'deleteRoute' => route('courses.groups.invitations.delete', [$group->course_id, $group->id, $invitation->id]),
            ]),
            'projects'    => $projects,
            'users'       => $group->users->each(fn(User $member) => [
                'isYou'           => $member->id == auth()->id(),
                'removeUserRoute' => route('courses.groups.removeMember', [$group->course_id, $group->id, $member->id]),
            ]),
            'deleteRoute' => route('courses.groups.destroy', [$group->course_id, $group->id]),
            'inviteRoute' => route('courses.groups.invite', [$group->course_id, $group->id]),
            'leaveRoute'  => route('courses.groups.leave', [$group->course_id, $group->id]),
            'canDelete'   => Gate::inspect('delete', $group)->toArray(),
            'canLeave'    => Gate::inspect('leave', $group)->toArray(),
            'isOwner'     => $group->users()->where('user_id', auth()->id())->wherePivot('is_owner', true)->exists(),
        ];
    }
}
