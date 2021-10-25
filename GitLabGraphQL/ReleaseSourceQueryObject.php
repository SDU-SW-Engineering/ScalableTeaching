<?php

namespace GraphQL\SchemaObject;

class ReleaseSourceQueryObject extends QueryObject
{
    const OBJECT_NAME = "ReleaseSource";

    public function selectFormat()
    {
        $this->selectField("format");

        return $this;
    }

    public function selectUrl()
    {
        $this->selectField("url");

        return $this;
    }
}
