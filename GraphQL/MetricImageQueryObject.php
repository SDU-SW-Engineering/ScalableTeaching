<?php

namespace GraphQL\SchemaObject;

class MetricImageQueryObject extends QueryObject
{
    const OBJECT_NAME = "MetricImage";

    public function selectFileName()
    {
        $this->selectField("fileName");

        return $this;
    }

    public function selectFilePath()
    {
        $this->selectField("filePath");

        return $this;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectIid()
    {
        $this->selectField("iid");

        return $this;
    }

    public function selectUrl()
    {
        $this->selectField("url");

        return $this;
    }
}
