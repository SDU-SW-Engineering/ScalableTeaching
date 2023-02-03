<?php

namespace Domain\GitLab\Definitions;

class Runner
{
    private int $id;

    private string $description;

    private string $runnerType;

    private bool $active;

    private bool $isShared;

    private array $tags;

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
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param  string  $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getRunnerType(): string
    {
        return $this->runnerType;
    }

    /**
     * @param  string  $runnerType
     */
    public function setRunnerType(string $runnerType): void
    {
        $this->runnerType = $runnerType;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param  bool  $active
     */
    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    /**
     * @return bool
     */
    public function isShared(): bool
    {
        return $this->isShared;
    }

    /**
     * @param  bool  $isShared
     */
    public function setIsShared(bool $isShared): void
    {
        $this->isShared = $isShared;
    }

    /**
     * @return array
     */
    public function getTags(): array
    {
        return $this->tags;
    }

    /**
     * @param  array  $tags
     */
    public function setTags(array $tags): void
    {
        $this->tags = $tags;
    }
}
