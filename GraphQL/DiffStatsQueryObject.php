<?php

namespace GraphQL\SchemaObject;

class DiffStatsQueryObject extends QueryObject
{
    const OBJECT_NAME = "DiffStats";

    public function selectAdditions()
    {
        $this->selectField("additions");

        return $this;
    }

    public function selectDeletions()
    {
        $this->selectField("deletions");

        return $this;
    }

    public function selectPath()
    {
        $this->selectField("path");

        return $this;
    }
}
