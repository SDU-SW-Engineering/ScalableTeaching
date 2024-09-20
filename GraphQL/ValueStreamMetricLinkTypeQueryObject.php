<?php

namespace GraphQL\SchemaObject;

class ValueStreamMetricLinkTypeQueryObject extends QueryObject
{
    const OBJECT_NAME = "ValueStreamMetricLinkType";

    public function selectDocsLink()
    {
        $this->selectField("docsLink");

        return $this;
    }

    public function selectLabel()
    {
        $this->selectField("label");

        return $this;
    }

    public function selectName()
    {
        $this->selectField("name");

        return $this;
    }

    public function selectUrl()
    {
        $this->selectField("url");

        return $this;
    }
}
