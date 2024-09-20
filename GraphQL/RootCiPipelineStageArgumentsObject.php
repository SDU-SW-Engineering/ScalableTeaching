<?php

namespace GraphQL\SchemaObject;

class RootCiPipelineStageArgumentsObject extends ArgumentsObject
{
    protected $id;

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
