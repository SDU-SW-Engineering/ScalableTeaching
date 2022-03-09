<?php

namespace App\Policies;

use App\Models\Enums\CorrectionType;
use App\Models\Project;
use App\Models\Survey;
use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SurveyPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function view(User $user, Survey $survey, ?Project $project) : bool
    {
        if ($project == null)
            return false;

        if ($project->isMissed)
            return false;

        $task = $survey->tasks()->wherePivot('task_id', $project->task_id)->first();
        if ($task == null)
            return false;

        if ($task->correction_type == CorrectionType::None && !$task->hasEnded)
            return false;

        if ($task->correction_type != CorrectionType::None && $project->status == 'active')
            return false;

        return !$task->pivot->isPastDeadline;
    }

    public function answer(User $user, Survey $survey, ?Project $project) : bool
    {
        if (!$this->view($user, $survey, $project))
            return false;

        return !$survey->responses()->project($project)->user($user)->exists();
    }
}
