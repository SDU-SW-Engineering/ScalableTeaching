<?php

namespace Domain\GitLab\Kinds;

use Domain\GitLab\Definitions\Commit;
use Domain\GitLab\Definitions\Project;
use Domain\GitLab\Definitions\User;

class Pipeline extends WebhookEvent
{
    private User $user;
    private Project $project;
    private Commit $commit;
    /**
     * @var \Domain\GitLab\Definitions\Build[] $builds
     */
    private array $builds;

    function Hydrate(array $array)
    {
        // TODO: Implement Hydrate() method.
    }

    /**
     * @return User
     */
    public function getUser() : User
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user) : void
    {
        $this->user = $user;
    }

    /**
     * @return Project
     */
    public function getProject() : Project
    {
        return $this->project;
    }

    /**
     * @param Project $project
     */
    public function setProject(Project $project) : void
    {
        $this->project = $project;
    }

    /**
     * @return Commit
     */
    public function getCommit() : Commit
    {
        return $this->commit;
    }

    /**
     * @param Commit $commit
     */
    public function setCommit(Commit $commit) : void
    {
        $this->commit = $commit;
    }

    /**
     * @return \Domain\GitLab\Definitions\Build[]
     */
    public function getBuilds() : array
    {
        return $this->builds;
    }

    /**
     * @param \Domain\GitLab\Definitions\Build[] $builds
     */
    public function setBuilds(array $builds) : void
    {
        $this->builds = $builds;
    }
}
