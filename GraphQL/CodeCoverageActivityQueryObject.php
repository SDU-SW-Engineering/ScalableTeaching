<?php

namespace GraphQL\SchemaObject;

class CodeCoverageActivityQueryObject extends QueryObject
{
    const OBJECT_NAME = "CodeCoverageActivity";

    public function selectAverageCoverage()
    {
        $this->selectField("averageCoverage");

        return $this;
    }

    public function selectCoverageCount()
    {
        $this->selectField("coverageCount");

        return $this;
    }

    public function selectDate()
    {
        $this->selectField("date");

        return $this;
    }

    public function selectProjectCount()
    {
        $this->selectField("projectCount");

        return $this;
    }
}
