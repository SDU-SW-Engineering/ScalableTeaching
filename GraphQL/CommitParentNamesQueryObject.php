<?php

namespace GraphQL\SchemaObject;

class CommitParentNamesQueryObject extends QueryObject
{
    const OBJECT_NAME = "CommitParentNames";

    public function selectNames()
    {
        $this->selectField("names");

        return $this;
    }
}
