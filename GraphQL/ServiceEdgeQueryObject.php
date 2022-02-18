<?php

namespace GraphQL\SchemaObject;

class ServiceEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "ServiceEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }
}
