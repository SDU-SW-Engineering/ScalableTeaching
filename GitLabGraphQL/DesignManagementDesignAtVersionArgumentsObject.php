<?php

namespace GraphQL\SchemaObject;

class DesignManagementDesignAtVersionArgumentsObject extends ArgumentsObject
{
    protected $id;

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
