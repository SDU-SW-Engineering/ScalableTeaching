<?php

namespace GraphQL\SchemaObject;

class DeploymentPermissionsQueryObject extends QueryObject
{
    const OBJECT_NAME = "DeploymentPermissions";

    public function selectDestroyDeployment()
    {
        $this->selectField("destroyDeployment");

        return $this;
    }

    public function selectUpdateDeployment()
    {
        $this->selectField("updateDeployment");

        return $this;
    }
}
