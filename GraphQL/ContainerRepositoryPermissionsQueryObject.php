<?php

namespace GraphQL\SchemaObject;

class ContainerRepositoryPermissionsQueryObject extends QueryObject
{
    const OBJECT_NAME = "ContainerRepositoryPermissions";

    public function selectDestroyContainerRepository()
    {
        $this->selectField("destroyContainerRepository");

        return $this;
    }
}
