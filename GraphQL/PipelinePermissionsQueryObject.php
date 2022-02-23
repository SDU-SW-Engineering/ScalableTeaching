<?php

namespace GraphQL\SchemaObject;

class PipelinePermissionsQueryObject extends QueryObject
{
    const OBJECT_NAME = "PipelinePermissions";

    public function selectAdminPipeline()
    {
        $this->selectField("adminPipeline");

        return $this;
    }

    public function selectDestroyPipeline()
    {
        $this->selectField("destroyPipeline");

        return $this;
    }

    public function selectUpdatePipeline()
    {
        $this->selectField("updatePipeline");

        return $this;
    }
}
