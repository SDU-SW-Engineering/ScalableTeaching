<?php

namespace Domain\GitLab\Definitions;

use Carbon\Carbon;

class Build
{
    private int $id;

    private string $stage;

    private string $name;

    private string $status;

    private Carbon $createdAt;

    private ?Carbon $startedAt;

    private ?Carbon $finished_At;

    private ?float $duration;

    private ?float $queuedDuration;

    private string $when;

    private bool $manual;

    private bool $allowFailure;

    private User $user;

    private Runner $runner;

    private ArtifactsFile $artifactsFile;

    private ?string $environment;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param  int  $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getStage(): string
    {
        return $this->stage;
    }

    /**
     * @param  string  $stage
     */
    public function setStage(string $stage): void
    {
        $this->stage = $stage;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param  string  $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param  string  $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return Carbon
     */
    public function getCreatedAt(): Carbon
    {
        return $this->createdAt;
    }

    /**
     * @param  Carbon  $createdAt
     */
    public function setCreatedAt(Carbon $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return Carbon|null
     */
    public function getStartedAt(): ?Carbon
    {
        return $this->startedAt;
    }

    /**
     * @param  Carbon|null  $startedAt
     */
    public function setStartedAt(?Carbon $startedAt): void
    {
        $this->startedAt = $startedAt;
    }

    /**
     * @return Carbon|null
     */
    public function getFinishedAt(): ?Carbon
    {
        return $this->finished_At;
    }

    /**
     * @param  Carbon|null  $finished_At
     */
    public function setFinishedAt(?Carbon $finished_At): void
    {
        $this->finished_At = $finished_At;
    }

    /**
     * @return float|null
     */
    public function getDuration(): ?float
    {
        return $this->duration;
    }

    /**
     * @param  float|null  $duration
     */
    public function setDuration(?float $duration): void
    {
        $this->duration = $duration;
    }

    /**
     * @return float|null
     */
    public function getQueuedDuration(): ?float
    {
        return $this->queuedDuration;
    }

    /**
     * @param  float|null  $queuedDuration
     */
    public function setQueuedDuration(?float $queuedDuration): void
    {
        $this->queuedDuration = $queuedDuration;
    }

    /**
     * @return string
     */
    public function getWhen(): string
    {
        return $this->when;
    }

    /**
     * @param  string  $when
     */
    public function setWhen(string $when): void
    {
        $this->when = $when;
    }

    /**
     * @return bool
     */
    public function isManual(): bool
    {
        return $this->manual;
    }

    /**
     * @param  bool  $manual
     */
    public function setManual(bool $manual): void
    {
        $this->manual = $manual;
    }

    /**
     * @return bool
     */
    public function isAllowFailure(): bool
    {
        return $this->allowFailure;
    }

    /**
     * @param  bool  $allowFailure
     */
    public function setAllowFailure(bool $allowFailure): void
    {
        $this->allowFailure = $allowFailure;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param  User  $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    /**
     * @return Runner
     */
    public function getRunner(): Runner
    {
        return $this->runner;
    }

    /**
     * @param  Runner  $runner
     */
    public function setRunner(Runner $runner): void
    {
        $this->runner = $runner;
    }

    /**
     * @return ArtifactsFile
     */
    public function getArtifactsFile(): ArtifactsFile
    {
        return $this->artifactsFile;
    }

    /**
     * @param  ArtifactsFile  $artifactsFile
     */
    public function setArtifactsFile(ArtifactsFile $artifactsFile): void
    {
        $this->artifactsFile = $artifactsFile;
    }

    /**
     * @return string|null
     */
    public function getEnvironment(): ?string
    {
        return $this->environment;
    }

    /**
     * @param  string|null  $environment
     */
    public function setEnvironment(?string $environment): void
    {
        $this->environment = $environment;
    }
}
