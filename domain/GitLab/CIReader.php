<?php

namespace Domain\GitLab;

use Symfony\Component\Yaml\Yaml;

class CIReader
{
    private array $stages = [];

    /**
     * @var CITask[]
     */
    private array $tasks = [];

    public function __construct(string $content)
    {
        $content = Yaml::parse($content);
        foreach ($content as $key => $part) {
            if (! is_array($part)) {
                continue;
            }
            if (! array_key_exists('script', $part)) {
                continue;
            }
            if (array_key_exists('stage', $part) && ! in_array($part['stage'], $this->stages)) {
                $this->stages[] = $part['stage'];
            }

            $this->tasks[] = new CITask(array_key_exists('stage', $part) ? $part['stage'] : null, $key);
        }
    }

    /**
     * @return CITask[]
     */
    public function tasks(): array
    {
        return $this->tasks;
    }

    /**
     * @return string[]
     */
    public function stages(): array
    {
        return $this->stages;
    }

    /**
     * @param  string  $name
     * @return CITask[]
     */
    public function stage(string $name): array
    {
        return array_filter($this->tasks, fn (CITask $task) => $task->getStage() == $name);
    }
}
