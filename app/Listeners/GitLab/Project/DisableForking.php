<?php

namespace App\Listeners\GitLab\Project;

use App\Events\ProjectCreated;
use Exception;
use GrahamCampbell\GitLab\GitLabManager;
use Illuminate\Contracts\Queue\ShouldQueue;

class DisableForking implements ShouldQueue
{
    public int $delay = 5;

    public int $tries = 5;

    public $backoff = [10, 30];

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param ProjectCreated $event
     * @return void
     * @throws Exception
     */
    public function handle(ProjectCreated $event)
    {
        $gitLabManager = app(GitLabManager::class);

        $project = $gitLabManager->projects()->show($event->project->project_id);
        if($project['import_error'] != null || $project['import_status'] != 'finished')
            throw new Exception("Import not fully done yet.");

        $gitLabManager->projects()->update($event->project->project_id, [
            'forking_access_level' => 'disabled'
        ]);
    }
}
