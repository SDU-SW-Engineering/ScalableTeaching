<?php

namespace GraphQL\SchemaObject;

class PipelineJobArgumentsObject extends ArgumentsObject
{
    protected $id;
    protected $name;

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}
