<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class CoursePolicy
{
    use HandlesAuthorization;

    const GROUP_DEFAULT_UPPER_LIMIT = 8;

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
     * @param Course $course
     * @return Response|bool
     */
    public function view(User $user, Course $course)
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
    }

    public function createGroup(User $user, Course $course)
    {
        $currentCount = $course->userGroups($user)->count();
        // todo: switch to match statement when using php8 in production
        if ($course->max_groups == 'same_as_assignments')
            $upperLimit = $course->tasks()->count();
        else if ($course->max_groups == 'custom')
            $upperLimit = $course->max_group_size;
        else
            $upperLimit = 0;

        return !($currentCount >= $upperLimit);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Course $course
     * @return Response|bool
     */
    public function update(User $user, Course $course)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Course $course
     * @return Response|bool
     */
    public function delete(User $user, Course $course)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Course $course
     * @return Response|bool
     */
    public function restore(User $user, Course $course)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param Course $course
     * @return Response|bool
     */
    public function forceDelete(User $user, Course $course)
    {
        //
    }
}
