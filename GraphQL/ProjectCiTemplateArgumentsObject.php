<?php

namespace GraphQL\SchemaObject;

class ProjectCiTemplateArgumentsObject extends ArgumentsObject
{
    protected $name;

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}
