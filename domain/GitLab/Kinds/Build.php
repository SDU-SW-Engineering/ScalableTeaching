<?php

namespace Domain\GitLab\Kinds;

use Carbon\Carbon;
use Domain\GitLab\Definitions\Commit;
use Domain\GitLab\Definitions\Repository;
use Domain\GitLab\Definitions\Runner;
use Domain\GitLab\Definitions\User;

class Build extends WebhookEvent
{
    private string $ref;
    private $tag;
    private string $beforeSha;
    private string $sha;
    private string $buildId;
    private string $buildName;
    private string $buildStage;
    private string $buildStatus;
    private Carbon $buildCreatedAt;
    private ?Carbon $buildStartedAt;
    private ?Carbon $buildFinishedAt;
    private ?float $buildDuration;
    private ?float $buildQueuedDuration;
    private bool $buildAllowFailure;
    private ?string $buildFailureReason;
    private int $pipelineId;
    private Runner $runner;
    private int $projectId;
    private string $projectName;
    private User $user;
    private Commit $commit;
    private Repository $repository;
    private ?string $environment;

    function Hydrate(array $array)
    {
        // TODO: Implement Hydrate() method.
    }

    /**
     * @return string
     */
    public function getRef() : string
    {
        return $this->ref;
    }

    /**
     * @param string $ref
     */
    public function setRef(string $ref) : void
    {
        $this->ref = $ref;
    }

    /**
     * @return mixed
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @param mixed $tag
     */
    public function setTag($tag) : void
    {
        $this->tag = $tag;
    }

    /**
     * @return string
     */
    public function getBeforeSha() : string
    {
        return $this->beforeSha;
    }

    /**
     * @param string $beforeSha
     */
    public function setBeforeSha(string $beforeSha) : void
    {
        $this->beforeSha = $beforeSha;
    }

    /**
     * @return string
     */
    public function getSha() : string
    {
        return $this->sha;
    }

    /**
     * @param string $sha
     */
    public function setSha(string $sha) : void
    {
        $this->sha = $sha;
    }

    /**
     * @return string
     */
    public function getBuildId() : string
    {
        return $this->buildId;
    }

    /**
     * @param string $buildId
     */
    public function setBuildId(string $buildId) : void
    {
        $this->buildId = $buildId;
    }

    /**
     * @return string
     */
    public function getBuildName() : string
    {
        return $this->buildName;
    }

    /**
     * @param string $buildName
     */
    public function setBuildName(string $buildName) : void
    {
        $this->buildName = $buildName;
    }

    /**
     * @return string
     */
    public function getBuildStage() : string
    {
        return $this->buildStage;
    }

    /**
     * @param string $buildStage
     */
    public function setBuildStage(string $buildStage) : void
    {
        $this->buildStage = $buildStage;
    }

    /**
     * @return string
     */
    public function getBuildStatus() : string
    {
        return $this->buildStatus;
    }

    /**
     * @param string $buildStatus
     */
    public function setBuildStatus(string $buildStatus) : void
    {
        $this->buildStatus = $buildStatus;
    }

    /**
     * @return Carbon
     */
    public function getBuildCreatedAt() : Carbon
    {
        return $this->buildCreatedAt;
    }

    /**
     * @param Carbon $buildCreatedAt
     */
    public function setBuildCreatedAt(Carbon $buildCreatedAt) : void
    {
        $this->buildCreatedAt = $buildCreatedAt;
    }

    /**
     * @return Carbon|null
     */
    public function getBuildStartedAt() : ?Carbon
    {
        return $this->buildStartedAt;
    }

    /**
     * @param Carbon|null $buildStartedAt
     */
    public function setBuildStartedAt(?Carbon $buildStartedAt) : void
    {
        $this->buildStartedAt = $buildStartedAt;
    }

    /**
     * @return Carbon|null
     */
    public function getBuildFinishedAt() : ?Carbon
    {
        return $this->buildFinishedAt;
    }

    /**
     * @param Carbon|null $buildFinishedAt
     */
    public function setBuildFinishedAt(?Carbon $buildFinishedAt) : void
    {
        $this->buildFinishedAt = $buildFinishedAt;
    }

    /**
     * @return float|null
     */
    public function getBuildDuration() : ?float
    {
        return $this->buildDuration;
    }

    /**
     * @param float|null $buildDuration
     */
    public function setBuildDuration(?float $buildDuration) : void
    {
        $this->buildDuration = $buildDuration;
    }

    /**
     * @return float|null
     */
    public function getBuildQueuedDuration() : ?float
    {
        return $this->buildQueuedDuration;
    }

    /**
     * @param float|null $buildQueuedDuration
     */
    public function setBuildQueuedDuration(?float $buildQueuedDuration) : void
    {
        $this->buildQueuedDuration = $buildQueuedDuration;
    }

    /**
     * @return bool
     */
    public function isBuildAllowFailure() : bool
    {
        return $this->buildAllowFailure;
    }

    /**
     * @param bool $buildAllowFailure
     */
    public function setBuildAllowFailure(bool $buildAllowFailure) : void
    {
        $this->buildAllowFailure = $buildAllowFailure;
    }

    /**
     * @return string|null
     */
    public function getBuildFailureReason() : ?string
    {
        return $this->buildFailureReason;
    }

    /**
     * @param string|null $buildFailureReason
     */
    public function setBuildFailureReason(?string $buildFailureReason) : void
    {
        $this->buildFailureReason = $buildFailureReason;
    }

    /**
     * @return int
     */
    public function getPipelineId() : int
    {
        return $this->pipelineId;
    }

    /**
     * @param int $pipelineId
     */
    public function setPipelineId(int $pipelineId) : void
    {
        $this->pipelineId = $pipelineId;
    }

    /**
     * @return Runner
     */
    public function getRunner() : Runner
    {
        return $this->runner;
    }

    /**
     * @param Runner $runner
     */
    public function setRunner(Runner $runner) : void
    {
        $this->runner = $runner;
    }

    /**
     * @return int
     */
    public function getProjectId() : int
    {
        return $this->projectId;
    }

    /**
     * @param int $projectId
     */
    public function setProjectId(int $projectId) : void
    {
        $this->projectId = $projectId;
    }

    /**
     * @return string
     */
    public function getProjectName() : string
    {
        return $this->projectName;
    }

    /**
     * @param string $projectName
     */
    public function setProjectName(string $projectName) : void
    {
        $this->projectName = $projectName;
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
     * @return Repository
     */
    public function getRepository() : Repository
    {
        return $this->repository;
    }

    /**
     * @param Repository $repository
     */
    public function setRepository(Repository $repository) : void
    {
        $this->repository = $repository;
    }

    /**
     * @return string|null
     */
    public function getEnvironment() : ?string
    {
        return $this->environment;
    }

    /**
     * @param string|null $environment
     */
    public function setEnvironment(?string $environment) : void
    {
        $this->environment = $environment;
    }
}
