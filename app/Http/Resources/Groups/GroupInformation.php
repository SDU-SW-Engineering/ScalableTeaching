<?php

namespace App\Http\Resources\Groups;

use App\Models\Group;
use App\Models\GroupInvitation;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Gate;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;
use JsonSerializable;

class GroupInformation extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable<int,int|string|Collection<string,string|bool>>|JsonSerializable
     */
    public function toArray($request)
    {
        /** @var Group $group */
        $group = $this->resource;
        $course = $group->course;
        $projects = $group->projects;

        $tasks = Task::findMany(array_map(function (Project $project) {
            return $project->task_id;
        }, $projects->all()));

        return [
            'id'          => $group->id,
            'name'        => $group->name,
            'memberCap'   => $course->max_group_size,
            'invitations' => $group->invitations->map(fn(GroupInvitation $invitation) => [
                'deleteRoute' => route('courses.groups.invitations.delete', [$group->course_id, $group->id, $invitation->id]),
                'recipient'   => $invitation->recipient,
            ]),
            'tasks'       => $tasks,
            'projects'    => $projects,
            'users'       => $group->members->map(fn(User $member) => [
                'name'            => $member->name,
                'isYou'           => $member->id == auth()->id(),
                'is_owner'        => $member->is_admin,
                'avatar'          => $member->avatar,
                'removeUserRoute' => route('courses.groups.removeMember', [$group->course_id, $group->id, $member->id]),
            ]),
            'deleteRoute' => route('courses.groups.destroy', [$group->course_id, $group->id]),
            'inviteRoute' => route('courses.groups.invite', [$group->course_id, $group->id]),
            'leaveRoute'  => route('courses.groups.leave', [$group->course_id, $group->id]),
            'canDelete'   => Gate::inspect('delete', $group)->toArray(),
            'canLeave'    => Gate::inspect('leave', $group)->toArray(),
            'isOwner'     => $group->members()->where('user_id', auth()->id())->wherePivot('is_owner', true)->exists(),
        ];
    }
}
