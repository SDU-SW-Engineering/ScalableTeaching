<?php

namespace GraphQL\SchemaObject;

class ProjectDeploymentArgumentsObject extends ArgumentsObject
{
    protected $iid;

    public function setIid($iid)
    {
        $this->iid = $iid;

        return $this;
    }
}
