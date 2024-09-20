<?php

namespace GraphQL\SchemaObject;

class CurrentUserSavedReplyArgumentsObject extends ArgumentsObject
{
    protected $id;

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
