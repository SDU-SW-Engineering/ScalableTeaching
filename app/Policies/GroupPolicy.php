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
        if (!$group->users()->where('user_id', $user->id)->wherePivot('is_owner', true)->exists())
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
}
