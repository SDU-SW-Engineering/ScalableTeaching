<?php

namespace App\Listeners\GitLab\Project;

use App\Events\ProjectCreated;
use App\Models\Project;
use GrahamCampbell\GitLab\GitLabManager;
use Http;
use Illuminate\Contracts\Queue\ShouldQueue;

class RefreshMemberAccess implements ShouldQueue
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
     * @param ProjectCreated $event
     * @return void
     */
    public function handle(ProjectCreated $event)
    {
        $gitLabManager = app(GitLabManager::class);
        $supposedMembers = $event->project->owners()->map(function($user) use ($gitLabManager) {
            $users = $gitLabManager->users()->all([
                'username' => $user->username
            ]);
            if(count($users) == 1)
                return $users[0]['id'];
            return null;
        })->reject(function($gitlabId) {
            return $gitlabId == null;
        });
        $currentMembers = collect($gitLabManager->projects()->members($event->project->project_id))->pluck('id');
        $add = $supposedMembers->diff($currentMembers);
        $remove = $currentMembers->diff($supposedMembers);
        $this->addUsersToGitlab($event->project, $add);
        $remove->each(function($gitlabUserId) use ($event, $gitLabManager) {
            try {
                $gitLabManager->projects()->removeMember($event->project->project_id, $gitlabUserId);
            } catch(\Exception $ignored) {

            }
        });
    }

    public function addUsersToGitlab(Project $project, $gitlabIds, &$errors = [])
    {
        foreach($gitlabIds as $user => $gitlabId) {
            $gitLabManager = app(GitLabManager::class);
            try {
                $gitLabManager->projects()->addMember($project->project_id, $gitlabId, 30);
            } catch(\Exception $e) {
                $message = strtolower($e->getMessage());
                if(\Str::contains($message, 'should be greater than or equal to'))
                    continue;
                if($message == 'member already exists')
                    continue;

                $errors[] = "$user: " . $e->getMessage();
            }
        }
    }
}
