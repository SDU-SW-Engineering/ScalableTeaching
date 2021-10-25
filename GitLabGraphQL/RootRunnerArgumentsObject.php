<?php

namespace GraphQL\SchemaObject;

class RootRunnerArgumentsObject extends ArgumentsObject
{
    protected $id;

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
