<?php

namespace GraphQL\SchemaObject;

class PackagePermissionsQueryObject extends QueryObject
{
    const OBJECT_NAME = "PackagePermissions";

    public function selectDestroyPackage()
    {
        $this->selectField("destroyPackage");

        return $this;
    }
}
