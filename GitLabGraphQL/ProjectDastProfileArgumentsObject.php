<?php

namespace GraphQL\SchemaObject;

class ProjectDastProfileArgumentsObject extends ArgumentsObject
{
    protected $id;

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
