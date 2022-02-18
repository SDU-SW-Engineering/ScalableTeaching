<?php

namespace GraphQL\SchemaObject;

class ComplianceFrameworkQueryObject extends QueryObject
{
    const OBJECT_NAME = "ComplianceFramework";

    public function selectColor()
    {
        $this->selectField("color");

        return $this;
    }

    public function selectDescription()
    {
        $this->selectField("description");

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

    public function selectPipelineConfigurationFullPath()
    {
        $this->selectField("pipelineConfigurationFullPath");

        return $this;
    }
}
