<?php

namespace App\Listeners\GitLab\Project;

use App\Events\GitLabProjectCreated;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisterWebhook implements ShouldQueue
{
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
     * @param  \App\Events\GitLabProjectCreated  $event
     * @return void
     */
    public function handle(GitLabProjectCreated $event)
    {
        //
    }
}
