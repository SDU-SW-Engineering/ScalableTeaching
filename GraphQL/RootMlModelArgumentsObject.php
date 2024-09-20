<?php

namespace GraphQL\SchemaObject;

class RootMlModelArgumentsObject extends ArgumentsObject
{
    protected $id;

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
