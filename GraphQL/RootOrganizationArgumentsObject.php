<?php

namespace GraphQL\SchemaObject;

class RootOrganizationArgumentsObject extends ArgumentsObject
{
    protected $id;

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
