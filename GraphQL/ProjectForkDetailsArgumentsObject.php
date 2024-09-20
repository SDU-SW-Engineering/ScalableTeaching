<?php

namespace GraphQL\SchemaObject;

class ProjectForkDetailsArgumentsObject extends ArgumentsObject
{
    protected $ref;

    public function setRef($ref)
    {
        $this->ref = $ref;

        return $this;
    }
}
