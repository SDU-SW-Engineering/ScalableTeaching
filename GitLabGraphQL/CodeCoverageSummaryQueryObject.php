<?php

namespace GraphQL\SchemaObject;

class CodeCoverageSummaryQueryObject extends QueryObject
{
    const OBJECT_NAME = "CodeCoverageSummary";

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

    public function selectLastUpdatedOn()
    {
        $this->selectField("lastUpdatedOn");

        return $this;
    }
}
