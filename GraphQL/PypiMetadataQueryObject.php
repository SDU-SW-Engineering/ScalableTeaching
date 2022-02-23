<?php

namespace GraphQL\SchemaObject;

class PypiMetadataQueryObject extends QueryObject
{
    const OBJECT_NAME = "PypiMetadata";

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectRequiredPython()
    {
        $this->selectField("requiredPython");

        return $this;
    }
}
