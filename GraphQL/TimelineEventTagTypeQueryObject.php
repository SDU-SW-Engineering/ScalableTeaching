<?php

namespace GraphQL\SchemaObject;

class TimelineEventTagTypeQueryObject extends QueryObject
{
    const OBJECT_NAME = "TimelineEventTagType";

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectName()
    {
        $this->selectField("name");

        return $this;
    }
}
