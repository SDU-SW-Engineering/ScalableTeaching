<?php

namespace App\Policies;

use App\Models\Group;
use App\Models\GroupInvitation;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class GroupPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

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
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Group $group
     * @return Response|bool
     */
    public function update(User $user, Group $group)
    {
        //
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
        if (!$this->isGroupOwner($group, $user))
            return Response::deny('Only the group owner can delete the group.');

        if ($group->users()->where('user_id', '!=', $user->id)->count())
            return Response::deny('Group needs to be empty before it can be deleted (excluding owner).');

        return true;
    }

    public function leave(User $user, Group $group)
    {
        $members = $group->users;
        $member = $members->firstWhere('id', $user->id);
        if ($member == null)
            return Response::deny('Not a member of the group.');

        if ($member->pivot->is_owner == true)
            return Response::deny('Owners can\'t leave the group, they should delete it instead.');

        return true;
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

        return true;
    }

    public function removeMember(User $user, Group $group, User $userToRemove)
    {
        if ($user->id == $userToRemove->id)
            return false;
        if (!$this->isGroupOwner($group, $user))
            return false;

        return true;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param Group $group
     * @return Response|bool
     */
    public function restore(User $user, Group $group)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param Group $group
     * @return Response|bool
     */
    public function forceDelete(User $user, Group $group)
    {
        //
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
