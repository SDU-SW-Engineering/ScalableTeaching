<?php

namespace GraphQL\SchemaObject;

class DiffStatsSummaryQueryObject extends QueryObject
{
    const OBJECT_NAME = "DiffStatsSummary";

    public function selectAdditions()
    {
        $this->selectField("additions");

        return $this;
    }

    public function selectChanges()
    {
        $this->selectField("changes");

        return $this;
    }

    public function selectDeletions()
    {
        $this->selectField("deletions");

        return $this;
    }

    public function selectFileCount()
    {
        $this->selectField("fileCount");

        return $this;
    }
}
