<?php

namespace GraphQL\SchemaObject;

class DesignVersionDesignAtVersionArgumentsObject extends ArgumentsObject
{
    protected $designId;
    protected $filename;
    protected $id;

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

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
