<?php

namespace GraphQL\SchemaObject;

class RootMilestoneArgumentsObject extends ArgumentsObject
{
    protected $id;

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
