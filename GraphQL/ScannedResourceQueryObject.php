<?php

namespace GraphQL\SchemaObject;

class ScannedResourceQueryObject extends QueryObject
{
    const OBJECT_NAME = "ScannedResource";

    public function selectRequestMethod()
    {
        $this->selectField("requestMethod");

        return $this;
    }

    public function selectUrl()
    {
        $this->selectField("url");

        return $this;
    }
}
