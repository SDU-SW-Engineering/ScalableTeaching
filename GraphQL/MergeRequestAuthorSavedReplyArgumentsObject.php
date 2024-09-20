<?php

namespace GraphQL\SchemaObject;

class MergeRequestAuthorSavedReplyArgumentsObject extends ArgumentsObject
{
    protected $id;

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
