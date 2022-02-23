<?php

namespace GraphQL\SchemaObject;

class CiBuildNeedQueryObject extends QueryObject
{
    const OBJECT_NAME = "CiBuildNeed";

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectName()
    {
        $this->selectField("name");

        return $this;
    }
}
