<?php

namespace GraphQL\SchemaObject;

class TimelogPermissionsQueryObject extends QueryObject
{
    const OBJECT_NAME = "TimelogPermissions";

    public function selectAdminTimelog()
    {
        $this->selectField("adminTimelog");

        return $this;
    }
}
