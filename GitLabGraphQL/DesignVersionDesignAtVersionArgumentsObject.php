<?php

namespace GraphQL\SchemaObject;

class DesignVersionDesignAtVersionArgumentsObject extends ArgumentsObject
{
    protected $id;
    protected $designId;
    protected $filename;

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function setDesignId($designId)
    {
        $this->designId = $designId;

        return $this;
    }

    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }
}
