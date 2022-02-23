<?php

namespace App\Observers;

use App\Models\Grade;
use App\Models\Project;
use App\Models\User;
use App\ProjectStatus;
use Exception;

class ProjectObserver
{
    /**
     * Handle the Project "saving" event.
     *
     * @param Project $project
     * @return void
     * @throws Exception
     */
    public function saving(Project $project)
    {
        if($project->status == ProjectStatus::Active || $project->status == null || $project->ownable_id == null)
            return;

        $project->owners()->each(fn(User $user) => Grade::create([
            'task_id'     => $project->task_id,
            'source_type' => Project::class,
            'source_id'   => $project->id,
            'user_id'     => $user->id,
            'value'       => match ($project->status) {
                ProjectStatus::Overdue => 'failed',
                ProjectStatus::Finished => 'passed',
                default => throw new Exception("Unexpected match value")
            }
        ]));
    }
}
