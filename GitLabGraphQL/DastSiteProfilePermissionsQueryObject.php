<?php

namespace GraphQL\SchemaObject;

class DastSiteProfilePermissionsQueryObject extends QueryObject
{
    const OBJECT_NAME = "DastSiteProfilePermissions";

    public function selectCreateOnDemandDastScan()
    {
        $this->selectField("createOnDemandDastScan");

        return $this;
    }
}
