<?php

namespace GraphQL\SchemaObject;

class MergeRequestMergeabilityCheckQueryObject extends QueryObject
{
    const OBJECT_NAME = "MergeRequestMergeabilityCheck";

    public function selectIdentifier()
    {
        $this->selectField("identifier");

        return $this;
    }

    public function selectStatus()
    {
        $this->selectField("status");

        return $this;
    }
}
