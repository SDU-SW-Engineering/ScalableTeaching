<?php

namespace GraphQL\SchemaObject;

class RecentFailuresQueryObject extends QueryObject
{
    const OBJECT_NAME = "RecentFailures";

    public function selectBaseBranch()
    {
        $this->selectField("baseBranch");

        return $this;
    }

    public function selectCount()
    {
        $this->selectField("count");

        return $this;
    }
}
