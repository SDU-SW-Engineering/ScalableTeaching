<?php

namespace App\Listeners;

use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Events\Authenticated;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SaveUserToDatabase
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
        /** @var \SDU\MFA\Azure\User $user */
        $user   = $event->user;
        $dbUser = User::updateOrCreate([
            'guid' => $user->getId(),
        ], [
            'name'  => $user->getDisplayName(),
            'email' => $user->getMail()
        ]);

        $this->addExistingProjects($dbUser);
    }

    private function addExistingProjects(User $user)
    {
        Project::whereNull('ownable_id')
            ->where('repo_name', $user->username)
            ->update([
                'ownable_id'   => $user->id,
                'ownable_type' => User::class
            ]);
    }
}
