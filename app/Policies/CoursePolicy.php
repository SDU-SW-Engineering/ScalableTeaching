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
    public function view(User $user, Course $course)
    {
        return $course->users()->where('user_id', $user->id)->exists();
    }


    public function createTask(User $user, Course $course)
    {
        return $course->hasTeacher($user);
    }

    public function createGroup(User $user, Course $course)
    {
        if ($course->hasMaxGroups($user))
            return Response::deny('Maximum number of groups reached.');
        return true;
    }

    public function manage(User $user, Course $course)
    {
        return $course->hasTeacher($user);
    }

    public function grade(User $user, Course $course)
    {
        return $this->manage($user, $course);
    }
}
