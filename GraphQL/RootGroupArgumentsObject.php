<?php

namespace GraphQL\SchemaObject;

class RootGroupArgumentsObject extends ArgumentsObject
{
    protected $fullPath;

    public function setFullPath($fullPath)
    {
        $this->fullPath = $fullPath;

        return $this;
    }
}
