<?php

namespace GraphQL\SchemaObject;

class AlertManagementPayloadAlertMappingFieldQueryObject extends QueryObject
{
    const OBJECT_NAME = "AlertManagementPayloadAlertMappingField";

    public function selectFieldName()
    {
        $this->selectField("fieldName");

        return $this;
    }

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
