<?php

namespace GraphQL\SchemaObject;

class RootGeoNodeArgumentsObject extends ArgumentsObject
{
    protected $name;

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}
