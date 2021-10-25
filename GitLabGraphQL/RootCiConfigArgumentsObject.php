<?php

namespace GraphQL\SchemaObject;

class RootCiConfigArgumentsObject extends ArgumentsObject
{
    protected $projectPath;
    protected $sha;
    protected $content;
    protected $dryRun;

    public function setProjectPath($projectPath)
    {
        $this->projectPath = $projectPath;

        return $this;
    }

    public function setSha($sha)
    {
        $this->sha = $sha;

        return $this;
    }

    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    public function setDryRun($dryRun)
    {
        $this->dryRun = $dryRun;

        return $this;
    }
}
