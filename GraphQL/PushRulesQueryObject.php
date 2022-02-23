<?php

namespace GraphQL\SchemaObject;

class PushRulesQueryObject extends QueryObject
{
    const OBJECT_NAME = "PushRules";

    public function selectRejectUnsignedCommits()
    {
        $this->selectField("rejectUnsignedCommits");

        return $this;
    }
}
