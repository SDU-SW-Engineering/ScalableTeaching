<?php

namespace GraphQL\SchemaObject;

class RootMergeRequestArgumentsObject extends ArgumentsObject
{
    protected $id;

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
