<?php

namespace GraphQL\SchemaObject;

class RequirementPermissionsQueryObject extends QueryObject
{
    const OBJECT_NAME = "RequirementPermissions";

    public function selectAdminRequirement()
    {
        $this->selectField("adminRequirement");

        return $this;
    }

    public function selectCreateRequirement()
    {
        $this->selectField("createRequirement");

        return $this;
    }

    public function selectDestroyRequirement()
    {
        $this->selectField("destroyRequirement");

        return $this;
    }

    public function selectReadRequirement()
    {
        $this->selectField("readRequirement");

        return $this;
    }

    public function selectUpdateRequirement()
    {
        $this->selectField("updateRequirement");

        return $this;
    }
}
