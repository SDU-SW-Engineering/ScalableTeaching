<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class CoursePolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Course $course
     * @return bool
     */
    public function view(User $user, Course $course) : bool
    {
        return $course->members()->where('user_id', $user->id)->exists();
    }

    public function create(User $user)
    {
        return false;
    }


    public function createTask(User $user, Course $course) : bool
    {
        return $course->hasTeacher($user);
    }

    public function createGroup(User $user, Course $course) : Response|bool
    {
        if ($course->hasMaxGroups($user))
            return Response::deny('Maximum number of groups reached.');

        return true;
    }

    public function manage(User $user, Course $course) : bool
    {
        return $course->hasTeacher($user);
    }

    public function grade(User $user, Course $course) : bool
    {
        return $this->manage($user, $course);
    }
}
