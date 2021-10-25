<?php

namespace GraphQL\SchemaObject;

class ScanQueryObject extends QueryObject
{
    const OBJECT_NAME = "Scan";

    public function selectErrors()
    {
        $this->selectField("errors");

        return $this;
    }

    public function selectName()
    {
        $this->selectField("name");

        return $this;
    }
}
