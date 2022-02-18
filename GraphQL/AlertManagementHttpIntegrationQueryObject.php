<?php

namespace GraphQL\SchemaObject;

class AlertManagementHttpIntegrationQueryObject extends QueryObject
{
    const OBJECT_NAME = "AlertManagementHttpIntegration";

    public function selectActive()
    {
        $this->selectField("active");

        return $this;
    }

    public function selectApiUrl()
    {
        $this->selectField("apiUrl");

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

    public function selectPayloadAlertFields(AlertManagementHttpIntegrationPayloadAlertFieldsArgumentsObject $argsObject = null)
    {
        $object = new AlertManagementPayloadAlertFieldQueryObject("payloadAlertFields");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPayloadAttributeMappings(AlertManagementHttpIntegrationPayloadAttributeMappingsArgumentsObject $argsObject = null)
    {
        $object = new AlertManagementPayloadAlertMappingFieldQueryObject("payloadAttributeMappings");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPayloadExample()
    {
        $this->selectField("payloadExample");

        return $this;
    }

    public function selectToken()
    {
        $this->selectField("token");

        return $this;
    }

    public function selectType()
    {
        $this->selectField("type");

        return $this;
    }

    public function selectUrl()
    {
        $this->selectField("url");

        return $this;
    }
}
