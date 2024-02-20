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
