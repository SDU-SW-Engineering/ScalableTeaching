<?php

namespace GraphQL\SchemaObject;

class ProjectPipelineArgumentsObject extends ArgumentsObject
{
    protected $iid;
    protected $sha;

    public function setIid($iid)
    {
        $this->iid = $iid;

        return $this;
    }

    public function setSha($sha)
    {
        $this->sha = $sha;

        return $this;
    }
}
