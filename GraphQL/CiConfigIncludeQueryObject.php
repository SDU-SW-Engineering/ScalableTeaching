<?php

namespace GraphQL\SchemaObject;

class CiConfigIncludeQueryObject extends QueryObject
{
    const OBJECT_NAME = "CiConfigInclude";

    public function selectBlob()
    {
        $this->selectField("blob");

        return $this;
    }

    public function selectContextProject()
    {
        $this->selectField("contextProject");

        return $this;
    }

    public function selectContextSha()
    {
        $this->selectField("contextSha");

        return $this;
    }

    public function selectExtra()
    {
        $this->selectField("extra");

        return $this;
    }

    public function selectLocation()
    {
        $this->selectField("location");

        return $this;
    }

    public function selectRaw()
    {
        $this->selectField("raw");

        return $this;
    }

    public function selectType()
    {
        $this->selectField("type");

        return $this;
    }
}
