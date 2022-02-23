<?php

namespace GraphQL\SchemaObject;

class UserPermissionsQueryObject extends QueryObject
{
    const OBJECT_NAME = "UserPermissions";

    public function selectCreateSnippet()
    {
        $this->selectField("createSnippet");

        return $this;
    }
}
