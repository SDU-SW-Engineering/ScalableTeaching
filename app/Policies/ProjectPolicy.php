<?php

namespace App\Policies;

use App\Models\Group;
use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability, ?Project $project)
    {
        if ($project != null && $project->task->course->hasTeacher($user))
            return true;
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {

    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param \App\Models\Project $project
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Project $project)
    {
        $currentProject = $project->task->currentProjectForUser($user);
        if ($currentProject == null)
            return false;
        return $currentProject->id == $project->id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param \App\Models\Project $project
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Project $project)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param \App\Models\Project $project
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Project $project)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param \App\Models\Project $project
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Project $project)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param \App\Models\Project $project
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Project $project)
    {
        //
    }

    public function migrate(User $user, Project $project, Group $group)
    {
        if ($project->ownable_type == Group::class)
            return false;
        if ($project->ownable->id != $user->id)
            return false;
        if ( ! $group->hasMember($user))
            return false;

        return true;
    }

    public function refreshAccess(User $user, Project $project)
    {
        return $project->owners()->contains('id', $user->id);
    }

    public function download(User $user, Project $project)
    {
        return false;
    }

    public function validate(User $user, Project $project)
    {
        return false;
    }
}
