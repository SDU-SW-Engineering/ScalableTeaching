<?php

namespace GraphQL\SchemaObject;

class CiGroupEnvironmentScopeQueryObject extends QueryObject
{
    const OBJECT_NAME = "CiGroupEnvironmentScope";

    public function selectName()
    {
        $this->selectField("name");

        return $this;
    }
}
