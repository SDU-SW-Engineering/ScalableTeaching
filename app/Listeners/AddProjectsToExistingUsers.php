<?php

namespace App\Listeners;

use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Events\Authenticated;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AddProjectsToExistingUsers
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
     * @param Login $event
     * @return void
     */
    public function handle(Login $event)
    {
        $this->addExistingProjects($event->user);
    }

    private function addExistingProjects(Authenticatable $user)
    {
        Project::whereNull('ownable_id')
            ->where('repo_name', $user->username)
            ->update([
                'ownable_id'   => $user->getAuthIdentifier(),
                'ownable_type' => User::class
            ]);
    }
}
