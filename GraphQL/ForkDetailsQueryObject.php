<?php

namespace GraphQL\SchemaObject;

class ForkDetailsQueryObject extends QueryObject
{
    const OBJECT_NAME = "ForkDetails";

    public function selectAhead()
    {
        $this->selectField("ahead");

        return $this;
    }

    public function selectBehind()
    {
        $this->selectField("behind");

        return $this;
    }

    public function selectHasConflicts()
    {
        $this->selectField("hasConflicts");

        return $this;
    }

    public function selectIsSyncing()
    {
        $this->selectField("isSyncing");

        return $this;
    }
}
