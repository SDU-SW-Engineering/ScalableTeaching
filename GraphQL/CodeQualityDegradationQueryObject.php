<?php

namespace GraphQL\SchemaObject;

class CodeQualityDegradationQueryObject extends QueryObject
{
    const OBJECT_NAME = "CodeQualityDegradation";

    public function selectDescription()
    {
        $this->selectField("description");

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

    public function selectPath()
    {
        $this->selectField("path");

        return $this;
    }

    public function selectSeverity()
    {
        $this->selectField("severity");

        return $this;
    }
}
