<?php

namespace App\Listeners\GitLab\Project;

use App\Events\ProjectCreated;
use App\Models\Project;
use GrahamCampbell\GitLab\GitLabManager;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;

class RegisterWebhook implements ShouldQueue
{
    public int $delay = 5;

    public int $tries = 3;

    /**
     * @var int[]
     */
    public array $backoff = [10, 30];

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
        if ( ! $event->project->task->isCodeTask())
        {
            return;
        }

        $manager = app(GitLabManager::class);
        $currentHooks = new Collection($manager->projects()->hooks($event->project->gitlab_project_id));
        if($currentHooks->isEmpty())
        {
            $webhookUrl = 'https://scalableteaching.sdu.dk/api/reporter';
            if (app()->environment('local') && getenv('VALET_DOMAIN') !== false)
            {
                $webhookUrl = getenv('VALET_DOMAIN') . "/api/reporter";
            }

            $response = $manager->projects()->addHook($event->project->gitlab_project_id, $webhookUrl, [
                'pipeline_events'         => true,
                'token'                   => Project::token($event->project),
                'enable_ssl_verification' => false,
            ]);

            $event->project->update([
                'hook_id' => $response['id'],
            ]);
        }
    }
}
