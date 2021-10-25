<?php

namespace GraphQL\SchemaObject;

class ScanExecutionPolicyQueryObject extends QueryObject
{
    const OBJECT_NAME = "ScanExecutionPolicy";

    public function selectDescription()
    {
        $this->selectField("description");

        return $this;
    }

    public function selectEnabled()
    {
        $this->selectField("enabled");

        return $this;
    }

    public function selectName()
    {
        $this->selectField("name");

        return $this;
    }

    public function selectUpdatedAt()
    {
        $this->selectField("updatedAt");

        return $this;
    }

    public function selectYaml()
    {
        $this->selectField("yaml");

        return $this;
    }
}
