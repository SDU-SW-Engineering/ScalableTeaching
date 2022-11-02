<?php

namespace App\Listeners\GitLab\Project;

use App\Events\ProjectCreated;

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
     * @param  ProjectCreated  $event
     * @return void
     */
    public function handle(ProjectCreated $event)
    {
        \App\Jobs\Project\RefreshMemberAccess::dispatch($event->project)->delay(5);
    }
}
