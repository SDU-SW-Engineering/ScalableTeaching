<?php

namespace GraphQL\SchemaObject;

class BoardEpicUserPreferencesQueryObject extends QueryObject
{
    const OBJECT_NAME = "BoardEpicUserPreferences";

    public function selectCollapsed()
    {
        $this->selectField("collapsed");

        return $this;
    }
}
