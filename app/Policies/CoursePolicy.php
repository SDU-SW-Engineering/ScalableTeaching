<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\User as UserModel;
use Illuminate\Auth\Access\Response;
use SDU\MFA\Azure\User;
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
        dd("hit");
        $user = UserModel::firstWhere(['guid' => $user->getId()]);
        $currentCount = $course->userGroups($user->id)->count();
        // todo: switch to match statement when using php8 in production
        if ($course->max_group_size == 0)
            $upperLimit = self::GROUP_DEFAULT_UPPER_LIMIT;
        else if ($course->max_group_size == 1)
            $upperLimit = 0;
        else
            $upperLimit = $course->tasks()->count();

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
