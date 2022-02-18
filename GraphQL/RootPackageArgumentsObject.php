<?php

namespace GraphQL\SchemaObject;

class RootPackageArgumentsObject extends ArgumentsObject
{
    protected $id;

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
