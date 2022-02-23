<?php

namespace GraphQL\SchemaObject;

class DesignManagementVersionArgumentsObject extends ArgumentsObject
{
    protected $id;

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
