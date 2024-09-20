<?php

namespace GraphQL\SchemaObject;

class CodequalityReportsComparerReportDegradationQueryObject extends QueryObject
{
    const OBJECT_NAME = "CodequalityReportsComparerReportDegradation";

    public function selectDescription()
    {
        $this->selectField("description");

        return $this;
    }

    public function selectEngineName()
    {
        $this->selectField("engineName");

        return $this;
    }

    public function selectFilePath()
    {
        $this->selectField("filePath");

        return $this;
    }

    public function selectFingerprint()
    {
        $this->selectField("fingerprint");

        return $this;
    }

    public function selectLine()
    {
        $this->selectField("line");

        return $this;
    }

    public function selectSeverity()
    {
        $this->selectField("severity");

        return $this;
    }

    public function selectWebUrl()
    {
        $this->selectField("webUrl");

        return $this;
    }
}
