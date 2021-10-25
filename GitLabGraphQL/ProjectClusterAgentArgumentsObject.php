<?php

namespace GraphQL\SchemaObject;

class ProjectClusterAgentArgumentsObject extends ArgumentsObject
{
    protected $name;

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}
