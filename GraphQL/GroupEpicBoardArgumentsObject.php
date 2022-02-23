<?php

namespace GraphQL\SchemaObject;

class GroupEpicBoardArgumentsObject extends ArgumentsObject
{
    protected $id;

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
