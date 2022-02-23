<?php

namespace GraphQL\SchemaObject;

class ProjectPipelineCountsArgumentsObject extends ArgumentsObject
{
    protected $ref;
    protected $sha;
    protected $source;

    public function setRef($ref)
    {
        $this->ref = $ref;

        return $this;
    }

    public function setSha($sha)
    {
        $this->sha = $sha;

        return $this;
    }

    public function setSource($source)
    {
        $this->source = $source;

        return $this;
    }
}
