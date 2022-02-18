<?php

namespace GraphQL\SchemaObject;

class AlertManagementIntegrationEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "AlertManagementIntegrationEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }
}
