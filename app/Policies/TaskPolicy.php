<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class TaskPolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Task $task
     * @return Response|bool
     */
    public function view(User $user, Task $task)
    {
        if ($task->course->hasTeacher($user))
            return true;

        return false;
    }

    public function viewAnalytics(User $user, Task $task)
    {
        if ($task->course->hasTeacher($user))
            return true;

        return false;
    }
}
