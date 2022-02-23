<?php

namespace GraphQL\SchemaObject;

class RunnerPermissionsQueryObject extends QueryObject
{
    const OBJECT_NAME = "RunnerPermissions";

    public function selectDeleteRunner()
    {
        $this->selectField("deleteRunner");

        return $this;
    }

    public function selectReadRunner()
    {
        $this->selectField("readRunner");

        return $this;
    }

    public function selectUpdateRunner()
    {
        $this->selectField("updateRunner");

        return $this;
    }
}
