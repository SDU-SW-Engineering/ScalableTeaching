<?php

namespace GraphQL\SchemaObject;

class AccessLevelQueryObject extends QueryObject
{
    const OBJECT_NAME = "AccessLevel";

    public function selectIntegerValue()
    {
        $this->selectField("integerValue");

        return $this;
    }

    public function selectStringValue()
    {
        $this->selectField("stringValue");

        return $this;
    }
}
