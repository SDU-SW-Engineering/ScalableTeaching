<?php

namespace GraphQL\SchemaObject;

class WorkItemPermissionsQueryObject extends QueryObject
{
    const OBJECT_NAME = "WorkItemPermissions";

    public function selectAdminParentLink()
    {
        $this->selectField("adminParentLink");

        return $this;
    }

    public function selectAdminWorkItem()
    {
        $this->selectField("adminWorkItem");

        return $this;
    }

    public function selectAdminWorkItemLink()
    {
        $this->selectField("adminWorkItemLink");

        return $this;
    }

    public function selectCreateNote()
    {
        $this->selectField("createNote");

        return $this;
    }

    public function selectDeleteWorkItem()
    {
        $this->selectField("deleteWorkItem");

        return $this;
    }

    public function selectReadWorkItem()
    {
        $this->selectField("readWorkItem");

        return $this;
    }

    public function selectSetWorkItemMetadata()
    {
        $this->selectField("setWorkItemMetadata");

        return $this;
    }

    public function selectUpdateWorkItem()
    {
        $this->selectField("updateWorkItem");

        return $this;
    }
}
