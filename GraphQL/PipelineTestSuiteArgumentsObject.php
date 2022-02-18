<?php

namespace GraphQL\SchemaObject;

class PipelineTestSuiteArgumentsObject extends ArgumentsObject
{
    protected $buildIds;

    public function setBuildIds(array $buildIds)
    {
        $this->buildIds = $buildIds;

        return $this;
    }
}
