<?php

use App\Models\User;

/**
 * @return User|null Returns the current authenticated user as our custom model type or null if the user is not authenticated.
 */
function user(): User|null
{
    /** @var User|null $user */
    $user = auth()->user();

    return $user;
}
