<?php

namespace GraphQL\SchemaObject;

class ProjectTerraformStateArgumentsObject extends ArgumentsObject
{
    protected $name;

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}
