<?php

namespace GraphQL\SchemaObject;

class WorkItemTypeQueryObject extends QueryObject
{
    const OBJECT_NAME = "WorkItemType";

    public function selectIconName()
    {
        $this->selectField("iconName");

        return $this;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectName()
    {
        $this->selectField("name");

        return $this;
    }
}
