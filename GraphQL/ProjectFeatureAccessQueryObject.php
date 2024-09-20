<?php

namespace GraphQL\SchemaObject;

class ProjectFeatureAccessQueryObject extends QueryObject
{
    const OBJECT_NAME = "ProjectFeatureAccess";

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
