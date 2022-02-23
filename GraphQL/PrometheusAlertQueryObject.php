<?php

namespace GraphQL\SchemaObject;

class PrometheusAlertQueryObject extends QueryObject
{
    const OBJECT_NAME = "PrometheusAlert";

    public function selectHumanizedText()
    {
        $this->selectField("humanizedText");

        return $this;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }
}
