<?php

namespace GraphQL\SchemaObject;

class QueryComplexityQueryObject extends QueryObject
{
    const OBJECT_NAME = "QueryComplexity";

    public function selectLimit()
    {
        $this->selectField("limit");

        return $this;
    }

    public function selectScore()
    {
        $this->selectField("score");

        return $this;
    }
}
