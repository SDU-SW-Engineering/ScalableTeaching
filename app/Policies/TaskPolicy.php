<?php

namespace App\Policies;

use App\Models\Enums\CorrectionType;
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
     * @return bool
     */
    public function view(User $user, Task $task)
    {
        if ($task->course->hasTeacher($user))
            return true;

        return false;
    }

    public function viewAnalytics(User $user, Task $task) : bool
    {
        if ($task->course->hasTeacher($user))
            return true;

        return false;
    }

    public function viewDashboard(User $user, Task $task) : bool
    {
        if ($task->course->hasTeacher($user))
            return true;

        return false;
    }
}
