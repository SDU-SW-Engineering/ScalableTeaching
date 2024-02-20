<?php

namespace GraphQL\SchemaObject;

class MergeRequestParticipantSavedReplyArgumentsObject extends ArgumentsObject
{
    protected $id;

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
