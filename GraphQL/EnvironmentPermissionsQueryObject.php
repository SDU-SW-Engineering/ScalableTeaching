<?php

namespace GraphQL\SchemaObject;

class EnvironmentPermissionsQueryObject extends QueryObject
{
    const OBJECT_NAME = "EnvironmentPermissions";

    public function selectDestroyEnvironment()
    {
        $this->selectField("destroyEnvironment");

        return $this;
    }

    public function selectStopEnvironment()
    {
        $this->selectField("stopEnvironment");

        return $this;
    }

    public function selectUpdateEnvironment()
    {
        $this->selectField("updateEnvironment");

        return $this;
    }
}
