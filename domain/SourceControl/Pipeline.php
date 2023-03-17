<?php

namespace Domain\SourceControl;

class Pipeline
{
    private array $jobs = [];

    public function __construct(public string $pipelineId, public string $createdAt, public string $status, public ?float $queueDuration, public ?float $duration)
    {

    }

    /**
     * @return array
     */
    public function getJobs(): array
    {
        return $this->jobs;
    }

    /**
     * @param array $jobs
     */
    public function setJobs(array $jobs): void
    {
        $this->jobs = $jobs;
    }
}
