<?php

namespace GraphQL\SchemaObject;

class GroupMemberMergeRequestInteractionArgumentsObject extends ArgumentsObject
{
    protected $id;

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
