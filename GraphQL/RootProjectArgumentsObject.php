<?php

namespace GraphQL\SchemaObject;

class RootProjectArgumentsObject extends ArgumentsObject
{
    protected $fullPath;

    public function setFullPath($fullPath)
    {
        $this->fullPath = $fullPath;

        return $this;
    }
}
