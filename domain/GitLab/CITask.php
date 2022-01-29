<?php

namespace Domain\GitLab;

class CITask
{
    public function __construct(
        private string $stage,
        private string $name
    ) {}

    /**
     * @return string
     */
    public function getStage() : string
    {
        return $this->stage;
    }

    /**
     * @param string $stage
     */
    public function setStage(string $stage) : void
    {
        $this->stage = $stage;
    }

    /**
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name) : void
    {
        $this->name = $name;
    }
}
