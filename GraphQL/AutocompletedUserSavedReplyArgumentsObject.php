<?php

namespace GraphQL\SchemaObject;

class AutocompletedUserSavedReplyArgumentsObject extends ArgumentsObject
{
    protected $id;

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
