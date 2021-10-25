<?php

namespace GraphQL\SchemaObject;

class DesignCollectionDesignAtVersionArgumentsObject extends ArgumentsObject
{
    protected $id;

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
