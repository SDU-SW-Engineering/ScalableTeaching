<?php

namespace App\Policies;

use App\Models\GroupInvitation;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GroupInvitationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can delete the model.
     *
     * @param  User  $user
     * @param  GroupInvitation  $groupInvitation
     * @return bool
     */
    public function delete(User $user, GroupInvitation $groupInvitation): bool
    {
        $groupMembers = $groupInvitation->group->members;

        return $groupMembers->contains('id', $user->id);
    }
}
