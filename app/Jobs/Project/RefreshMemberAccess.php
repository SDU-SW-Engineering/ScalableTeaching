<?php

namespace App\Jobs\Project;

use App\Models\Project;
use App\Models\User;
use Domain\GitLab\Definitions\GitLabUserAccessLevelEnum;
use GrahamCampbell\GitLab\GitLabManager;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class RefreshMemberAccess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Project $project;

    public int $tries = 5;

    /**
     * @var int[]
     */
    public array $backoff = [10, 30];

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Project $project)
    {
        $this->project = $project;
    }


    public function handle() : void
    {
        if ( ! $this->project->task->isCodeTask()) return;

        $gitLabManager = app(GitLabManager::class);

        $supposedMemberIds = $this->project->owners()->map(function(User $user) {
            return $user->gitlab_id;
        });

        $currentMemberIds = (new Collection($gitLabManager->projects()->members($this->project->gitlab_project_id)))->pluck('id');

        $memberIdsToAdd = $supposedMemberIds->diff($currentMemberIds);
        $memberIdsToRemove = $currentMemberIds->diff($supposedMemberIds);

        $this->addUsersToGitlabProject($this->project, $memberIdsToAdd);
        $this->removeUsersFromGitlabProject($this->project, $memberIdsToRemove);
    }

    /**
     * @param Project $project
     * @param Collection<int,int> $gitlabUserIds
     * @return void
     */
    public function addUsersToGitlabProject(Project $project, Collection $gitlabUserIds) : void
    {
        foreach($gitlabUserIds as $gitlabId)
        {
            $gitLabManager = app(GitLabManager::class);
            try
            {
                $gitLabManager->projects()->addMember($project->gitlab_project_id, $gitlabId, GitLabUserAccessLevelEnum::DEVELOPER->value);
            } catch(\Exception $e)
            {
                $message = strtolower($e->getMessage());
                if(\Str::contains($message, 'should be greater than or equal to')) // TODO: Figure out what these errors mean, and document it.
                    continue;
                if($message == 'member already exists')
                    continue;

                Log::error("Failed to add user with gitlabId {$gitlabId} to project {$project->id} - Error: {$e->getMessage()}");
            }
        }
    }

    /**
     * @param Project $project
     * @param Collection<int,int> $gitlabUserIds
     * @return void
     */
    public function removeUsersFromGitlabProject(Project $project, Collection $gitlabUserIds) : void
    {
        foreach($gitlabUserIds as $gitlabId)
        {
            $gitLabManager = app(GitLabManager::class);
            try
            {
                $gitLabManager->projects()->removeMember($project->gitlab_project_id, $gitlabId);
            } catch(\Exception $e)
            {
                Log::error("Failed to remove user with gitlab id {$gitlabId} from project {$project->id} - Error: {$e->getMessage()}");
            }
        }
    }
}
