<?php

namespace GraphQL\SchemaObject;

class RootIssueArgumentsObject extends ArgumentsObject
{
    protected $id;

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
