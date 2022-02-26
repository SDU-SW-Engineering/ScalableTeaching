<?php

namespace App\Listeners\GitLab\Project;

use App\Events\ProjectCreated;
use App\Models\Project;
use GrahamCampbell\GitLab\GitLabManager;
use Http;
use Illuminate\Contracts\Queue\ShouldQueue;

class RefreshMemberAccess
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }


    /**
     * Handle the event.
     *
     * @param ProjectCreated $event
     * @return void
     */
    public function handle(ProjectCreated $event)
    {
        \App\Jobs\Project\RefreshMemberAccess::dispatch($event->project);
    }

}
