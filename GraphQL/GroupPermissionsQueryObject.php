<?php

namespace GraphQL\SchemaObject;

class GroupPermissionsQueryObject extends QueryObject
{
    const OBJECT_NAME = "GroupPermissions";

    public function selectCreateCustomEmoji()
    {
        $this->selectField("createCustomEmoji");

        return $this;
    }

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
