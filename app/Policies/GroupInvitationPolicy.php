<?php

namespace App\Policies;

use App\Models\GroupInvitation;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Database\Eloquent\Collection;

class GroupInvitationPolicy
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
     * @param GroupInvitation $groupInvitation
     * @return Response|bool
     */
    public function view(User $user, GroupInvitation $groupInvitation)
    {
        //
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
     * @param GroupInvitation $groupInvitation
     * @return Response|bool
     */
    public function update(User $user, GroupInvitation $groupInvitation)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param GroupInvitation $groupInvitation
     * @return Response|bool
     */
    public function delete(User $user, GroupInvitation $groupInvitation)
    {
        /** @var Collection $groupMembers */
        $groupMembers = $groupInvitation->group->users;
        return $groupMembers->contains('id', $user->id);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param GroupInvitation $groupInvitation
     * @return Response|bool
     */
    public function restore(User $user, GroupInvitation $groupInvitation)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param GroupInvitation $groupInvitation
     * @return Response|bool
     */
    public function forceDelete(User $user, GroupInvitation $groupInvitation)
    {
        //
    }
}
