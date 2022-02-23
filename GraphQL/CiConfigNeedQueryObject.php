<?php

namespace GraphQL\SchemaObject;

class CiConfigNeedQueryObject extends QueryObject
{
    const OBJECT_NAME = "CiConfigNeed";

    public function selectName()
    {
        $this->selectField("name");

        return $this;
    }
}
