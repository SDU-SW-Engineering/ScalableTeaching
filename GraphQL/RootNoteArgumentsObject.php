<?php

namespace GraphQL\SchemaObject;

class RootNoteArgumentsObject extends ArgumentsObject
{
    protected $id;

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
