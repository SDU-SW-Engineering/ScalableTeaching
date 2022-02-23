<?php

namespace GraphQL\SchemaObject;

class ProjectBoardArgumentsObject extends ArgumentsObject
{
    protected $id;

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
