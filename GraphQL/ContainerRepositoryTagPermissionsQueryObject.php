<?php

namespace GraphQL\SchemaObject;

class ContainerRepositoryTagPermissionsQueryObject extends QueryObject
{
    const OBJECT_NAME = "ContainerRepositoryTagPermissions";

    public function selectDestroyContainerRepositoryTag()
    {
        $this->selectField("destroyContainerRepositoryTag");

        return $this;
    }
}
