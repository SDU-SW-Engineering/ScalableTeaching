<?php

namespace GraphQL\SchemaObject;

class RootIterationArgumentsObject extends ArgumentsObject
{
    protected $id;

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
