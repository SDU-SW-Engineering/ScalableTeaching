<?php

namespace GraphQL\SchemaObject;

class RootWorkItemArgumentsObject extends ArgumentsObject
{
    protected $id;

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
