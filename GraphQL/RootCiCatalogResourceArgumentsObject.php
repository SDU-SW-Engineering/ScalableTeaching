<?php

namespace GraphQL\SchemaObject;

class RootCiCatalogResourceArgumentsObject extends ArgumentsObject
{
    protected $id;
    protected $fullPath;

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function setFullPath($fullPath)
    {
        $this->fullPath = $fullPath;

        return $this;
    }
}
