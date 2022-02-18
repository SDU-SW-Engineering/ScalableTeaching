<?php

namespace GraphQL\SchemaObject;

class MemberInterfaceEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "MemberInterfaceEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }
}
