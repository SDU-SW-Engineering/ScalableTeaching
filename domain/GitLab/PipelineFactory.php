<?php

namespace Domain\GitLab;

use Domain\GitLab\Kinds\Build;
use Domain\GitLab\Kinds\Pipeline;
use Domain\GitLab\Kinds\WebhookEvent;

class PipelineFactory
{
    private $stages = [];

    public function addStage(string $name, int $taskCount)
    {

    }

    /**
     * @return WebhookEvent[]
     */
    public function fullPipeline() : array
    {
        foreach ($this->stages as $stage)
        {

        }
    }

    public static function pipeline(int $projectId) : Pipeline
    {

    }

    public static function build(int $projectId, int $pipelineId) : Build
    {

    }

    public static function next(Build $build) : Build
    {
    }
}
