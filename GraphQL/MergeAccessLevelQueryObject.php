<?php

namespace GraphQL\SchemaObject;

class MergeAccessLevelQueryObject extends QueryObject
{
    const OBJECT_NAME = "MergeAccessLevel";

    public function selectAccessLevel()
    {
        $this->selectField("accessLevel");

        return $this;
    }

    public function selectAccessLevelDescription()
    {
        $this->selectField("accessLevelDescription");

        return $this;
    }
}
