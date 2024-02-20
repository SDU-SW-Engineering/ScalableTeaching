<?php

namespace GraphQL\SchemaObject;

class OrganizationStateCountsQueryObject extends QueryObject
{
    const OBJECT_NAME = "OrganizationStateCounts";

    public function selectActive()
    {
        $this->selectField("active");

        return $this;
    }

    public function selectAll()
    {
        $this->selectField("all");

        return $this;
    }

    public function selectInactive()
    {
        $this->selectField("inactive");

        return $this;
    }
}
