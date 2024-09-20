<?php

namespace GraphQL\SchemaObject;

class ProjectCiConfigVariablesArgumentsObject extends ArgumentsObject
{
    protected $ref;

    public function setRef($ref)
    {
        $this->ref = $ref;

        return $this;
    }
}
