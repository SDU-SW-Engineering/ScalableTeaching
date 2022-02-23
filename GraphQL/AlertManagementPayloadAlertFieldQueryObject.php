<?php

namespace GraphQL\SchemaObject;

class AlertManagementPayloadAlertFieldQueryObject extends QueryObject
{
    const OBJECT_NAME = "AlertManagementPayloadAlertField";

    public function selectLabel()
    {
        $this->selectField("label");

        return $this;
    }

    public function selectPath()
    {
        $this->selectField("path");

        return $this;
    }

    public function selectType()
    {
        $this->selectField("type");

        return $this;
    }
}
