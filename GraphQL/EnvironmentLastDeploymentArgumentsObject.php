<?php

namespace GraphQL\SchemaObject;

use GraphQL\RawObject;

class EnvironmentLastDeploymentArgumentsObject extends ArgumentsObject
{
    protected $status;

    public function setStatus($deploymentStatus)
    {
        $this->status = new RawObject($deploymentStatus);

        return $this;
    }
}
