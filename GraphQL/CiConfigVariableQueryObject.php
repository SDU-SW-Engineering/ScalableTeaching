<?php

namespace GraphQL\SchemaObject;

class CiConfigVariableQueryObject extends QueryObject
{
    const OBJECT_NAME = "CiConfigVariable";

    public function selectDescription()
    {
        $this->selectField("description");

        return $this;
    }

    public function selectKey()
    {
        $this->selectField("key");

        return $this;
    }

    public function selectValue()
    {
        $this->selectField("value");

        return $this;
    }

    public function selectValueOptions()
    {
        $this->selectField("valueOptions");

        return $this;
    }
}
