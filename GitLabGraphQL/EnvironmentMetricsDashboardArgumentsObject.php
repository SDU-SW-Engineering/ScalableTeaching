<?php

namespace GraphQL\SchemaObject;

class EnvironmentMetricsDashboardArgumentsObject extends ArgumentsObject
{
    protected $path;

    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }
}
