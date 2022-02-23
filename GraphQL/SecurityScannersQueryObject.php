<?php

namespace GraphQL\SchemaObject;

class SecurityScannersQueryObject extends QueryObject
{
    const OBJECT_NAME = "SecurityScanners";

    public function selectAvailable()
    {
        $this->selectField("available");

        return $this;
    }

    public function selectEnabled()
    {
        $this->selectField("enabled");

        return $this;
    }

    public function selectPipelineRun()
    {
        $this->selectField("pipelineRun");

        return $this;
    }
}
