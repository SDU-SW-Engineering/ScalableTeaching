<?php

namespace GraphQL\SchemaObject;

class DiffRefsQueryObject extends QueryObject
{
    const OBJECT_NAME = "DiffRefs";

    public function selectBaseSha()
    {
        $this->selectField("baseSha");

        return $this;
    }

    public function selectHeadSha()
    {
        $this->selectField("headSha");

        return $this;
    }

    public function selectStartSha()
    {
        $this->selectField("startSha");

        return $this;
    }
}
