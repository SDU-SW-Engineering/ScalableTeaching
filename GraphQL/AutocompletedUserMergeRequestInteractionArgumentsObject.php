<?php

namespace GraphQL\SchemaObject;

class AutocompletedUserMergeRequestInteractionArgumentsObject extends ArgumentsObject
{
    protected $id;

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
