<?php

namespace GraphQL\SchemaObject;

class ProjectMemberMergeRequestInteractionArgumentsObject extends ArgumentsObject
{
    protected $id;

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
