<?php

namespace App\Listeners\GitLab\Project;

use App\Events\ProjectCreated;
use App\Models\Project;
use GrahamCampbell\GitLab\GitLabManager;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisterWebhook implements ShouldQueue
{
    public int $delay = 5;

    public int $tries = 3;

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
     */
    public function handle(ProjectCreated $event)
    {
        $manager = app(GitLabManager::class);
        $currentHooks = collect($manager->projects()->hooks($event->project->project_id));
        if($currentHooks->isEmpty()) {
            $response = $manager->projects()->addHook($event->project->project_id, 'https://scalableteaching.sdu.dk/api/reporter', [
                'pipeline_events'         => true,
                'token'                   => Project::token($event->project),
                'enable_ssl_verification' => false
            ]);

            $event->project->update([
                'hook_id' => $response['id']
            ]);
        }
    }
}
