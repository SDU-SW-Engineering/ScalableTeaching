<?php

namespace GraphQL\SchemaObject;

class SastCiConfigurationOptionsEntityQueryObject extends QueryObject
{
    const OBJECT_NAME = "SastCiConfigurationOptionsEntity";

    public function selectLabel()
    {
        $this->selectField("label");

        return $this;
    }

    public function selectValue()
    {
        $this->selectField("value");

        return $this;
    }
}
