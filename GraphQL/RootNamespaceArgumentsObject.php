<?php

namespace GraphQL\SchemaObject;

class RootNamespaceArgumentsObject extends ArgumentsObject
{
    protected $fullPath;

    public function setFullPath($fullPath)
    {
        $this->fullPath = $fullPath;

        return $this;
    }
}
