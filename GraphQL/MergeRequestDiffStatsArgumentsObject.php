<?php

namespace GraphQL\SchemaObject;

class MergeRequestDiffStatsArgumentsObject extends ArgumentsObject
{
    protected $path;

    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }
}
