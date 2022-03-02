<?php

namespace App\Jobs\Project;

use App\Events\ProjectCreated;
use App\Models\Project;
use App\Models\User;
use GrahamCampbell\GitLab\GitLabManager;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class RefreshMemberAccess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Project $project;

    public $delay = 5;

    public $tries = 5;

    public $backoff = [10, 30];

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Project $project)
    {
        $this->project = $project;
    }


    public function handle()
    {
        $gitLabManager = app(GitLabManager::class);
        $supposedMembers = $this->project->owners()->map(function(User $user) use ($gitLabManager) {
            $users = $gitLabManager->users()->all([
                'username' => $user->username
            ]);
            if(count($users) == 1)
                return $users[0]['id'];
            return null;
        })->reject(function($gitlabId) {
            return $gitlabId == null;
        });
        $currentMembers = collect($gitLabManager->projects()->members($this->project->project_id))->pluck('id');
        $add = $supposedMembers->diff($currentMembers);
        $remove = $currentMembers->diff($supposedMembers);
        $this->addUsersToGitlab($this->project, $add);
        $remove->each(function($gitlabUserId) use ($gitLabManager) {
            try {
                $gitLabManager->projects()->removeMember($this->project->project_id, $gitlabUserId);
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
