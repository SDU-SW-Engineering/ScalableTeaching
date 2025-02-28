<?php

namespace App\Listeners\GitLab\Project;

use App\Events\ProjectDeleting;
use App\Models\Project;
use App\Models\Task;
use App\Modules\LinkRepository\LinkRepository;
use GrahamCampbell\GitLab\GitLabManager;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Log;

class CleanupRepositoryOnProjectDelete implements ShouldQueue
{

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @param ProjectDeleting $event
     * @return void
     */
    public function handle(ProjectDeleting $event): void
    {
        $project = $event->project;
        $task = $project->task;

        if ($task->isTemplateTask())
        {
            Log::info("Deleting repository associated project {$project->id} (Owner(s):{$project->ownerNames})");
            $gitLabManager = app(GitLabManager::class);
            $gitLabManager->projects()->remove($project->gitlab_project_id);
        } elseif ($task->isCodeTask())
        {
            Log::info("Removing member(s) of project {$project->id} (Owner(s):{$project->ownerNames})");
            $gitLabManager = app(GitLabManager::class);
            foreach ($project->owners()->all() as $user)
            {
                $gitLabManager->projects()->removeMember($task->getGitlabProjectId(), $user->gitlab_id);
            }
        }
    }
}
