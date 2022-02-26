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
}
