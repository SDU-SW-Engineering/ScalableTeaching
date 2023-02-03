<?php

namespace Domain\GitLab\Definitions;

use Carbon\Carbon;

class Commit
{
    private int $id;

    private string $sha;

    private string $message;

    private string $authorName;

    private string $authorEmail;

    private string $authorUrl;

    private ?string $status;

    private float $duration;

    private ?Carbon $startedAt;

    private ?Carbon $finishedAt;

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
    public function getSha(): string
    {
        return $this->sha;
    }

    /**
     * @param  string  $sha
     */
    public function setSha(string $sha): void
    {
        $this->sha = $sha;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param  string  $message
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getAuthorName(): string
    {
        return $this->authorName;
    }

    /**
     * @param  string  $authorName
     */
    public function setAuthorName(string $authorName): void
    {
        $this->authorName = $authorName;
    }

    /**
     * @return string
     */
    public function getAuthorEmail(): string
    {
        return $this->authorEmail;
    }

    /**
     * @param  string  $authorEmail
     */
    public function setAuthorEmail(string $authorEmail): void
    {
        $this->authorEmail = $authorEmail;
    }

    /**
     * @return string
     */
    public function getAuthorUrl(): string
    {
        return $this->authorUrl;
    }

    /**
     * @param  string  $authorUrl
     */
    public function setAuthorUrl(string $authorUrl): void
    {
        $this->authorUrl = $authorUrl;
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param  string|null  $status
     */
    public function setStatus(?string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return float
     */
    public function getDuration(): float
    {
        return $this->duration;
    }

    /**
     * @param  float  $duration
     */
    public function setDuration(float $duration): void
    {
        $this->duration = $duration;
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
        return $this->finishedAt;
    }

    /**
     * @param  Carbon|null  $finishedAt
     */
    public function setFinishedAt(?Carbon $finishedAt): void
    {
        $this->finishedAt = $finishedAt;
    }
}
