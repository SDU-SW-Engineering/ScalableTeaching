<?php

namespace GraphQL\SchemaObject;

class RootTodoArgumentsObject extends ArgumentsObject
{
    protected $id;

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
