<?php

namespace GraphQL\SchemaObject;

class GroupPermissionsQueryObject extends QueryObject
{
    const OBJECT_NAME = "GroupPermissions";

    public function selectCreateProjects()
    {
        $this->selectField("createProjects");

        return $this;
    }

    public function selectReadGroup()
    {
        $this->selectField("readGroup");

        return $this;
    }
}
