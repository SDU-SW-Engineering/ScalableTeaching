<?php

namespace GraphQL\SchemaObject;

class IssueStatusCountsTypeQueryObject extends QueryObject
{
    const OBJECT_NAME = "IssueStatusCountsType";

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
