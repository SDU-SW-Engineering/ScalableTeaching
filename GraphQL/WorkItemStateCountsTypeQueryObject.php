<?php

namespace GraphQL\SchemaObject;

class WorkItemStateCountsTypeQueryObject extends QueryObject
{
    const OBJECT_NAME = "WorkItemStateCountsType";

    public function selectAll()
    {
        $this->selectField("all");

        return $this;
    }

    public function selectClosed()
    {
        $this->selectField("closed");

        return $this;
    }

    public function selectOpened()
    {
        $this->selectField("opened");

        return $this;
    }
}
