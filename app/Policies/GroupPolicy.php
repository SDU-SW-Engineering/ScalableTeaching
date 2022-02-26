<?php

namespace App\Policies;

use App\Models\Group;
use App\Models\GroupInvitation;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class GroupPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Group $group
     * @return Response|bool
     */
    public function view(User $user, Group $group)
    {
        return $group->users()->where('user_id', $user->id)->exists();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Group $group
     * @return Response|bool
     */
    public function delete(User $user, Group $group)
    {
        if ( ! $this->isGroupOwner($group, $user))
            return Response::deny('Only the group owner can delete the group.');

        if ($group->users()->where('user_id', '!=', $user->id)->count())
            return Response::deny('Group needs to be empty before it can be deleted (excluding owner).');

        if ($group->projects()->count() > 0)
            return Response::deny('A group can\'t be deleted once it has a project attached to it.');

        return true;
    }

    public function leave(User $user, Group $group)
    {
        $members = $group->users;
        $member  = $members->firstWhere('id', $user->id);
        if ($member == null)
            return Response::deny('Not a member of the group.');

        if ($member->getRelationValue('pivot')->is_owner == true)
            return Response::deny('Owners can\'t leave the group, they should delete it instead.');

        return true;
    }

    public function canStartProject(User $user, Group $group)
    {
        return $this->view($user, $group);
    }

    public function invite(User $user, Group $group)
    {
        return $this->view($user, $group);
    }

    public function respondInvite(User $user, Group $group, GroupInvitation $groupInvitation)
    {
        return $groupInvitation->recipient_user_id == $user->id;
    }

    public function canAcceptInvite(User $user, Group $group, GroupInvitation $groupInvitation)
    {
        if ($group->users()->count() >= $group->course->max_group_size)
            return Response::deny("Group is full.");
        if ($group->course->hasMaxGroups($user))
            return Response::deny("Maximum number of groups reached.");

        $userIsEligible = $group->projects->every(fn (Project $project) => $project->task->currentProjectForUser($user) == null);
        if (!$userIsEligible)
            return Response::deny("This group is already working on a project that you have also started.");

        return true;
    }

    public function removeMember(User $user, Group $group, User $userToRemove)
    {
        if ($user->id == $userToRemove->id)
            return false;
        if ( ! $this->isGroupOwner($group, $user))
            return false;

        return true;
    }

    /**
     * @param Group $group
     * @param User $user
     * @return bool
     */
    private function isGroupOwner(Group $group, User $user) : bool
    {
        return $group->users()->where('user_id', $user->id)->wherePivot('is_owner', true)->exists();
    }
}
