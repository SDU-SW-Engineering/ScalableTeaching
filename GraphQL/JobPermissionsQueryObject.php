<?php

namespace GraphQL\SchemaObject;

class JobPermissionsQueryObject extends QueryObject
{
    const OBJECT_NAME = "JobPermissions";

    public function selectCancelBuild()
    {
        $this->selectField("cancelBuild");

        return $this;
    }

    public function selectReadBuild()
    {
        $this->selectField("readBuild");

        return $this;
    }

    public function selectReadJobArtifacts()
    {
        $this->selectField("readJobArtifacts");

        return $this;
    }

    public function selectUpdateBuild()
    {
        $this->selectField("updateBuild");

        return $this;
    }
}
