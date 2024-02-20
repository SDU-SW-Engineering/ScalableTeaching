<?php

namespace GraphQL\SchemaObject;

class ContactStateCountsQueryObject extends QueryObject
{
    const OBJECT_NAME = "ContactStateCounts";

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
