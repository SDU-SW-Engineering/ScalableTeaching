<?php

namespace GraphQL\SchemaObject;

class DesignCollectionDesignArgumentsObject extends ArgumentsObject
{
    protected $id;
    protected $filename;

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }
}
