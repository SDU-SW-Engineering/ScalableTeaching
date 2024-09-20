<?php

namespace GraphQL\SchemaObject;

class CodequalityReportsComparerReportSummaryQueryObject extends QueryObject
{
    const OBJECT_NAME = "CodequalityReportsComparerReportSummary";

    public function selectErrored()
    {
        $this->selectField("errored");

        return $this;
    }

    public function selectResolved()
    {
        $this->selectField("resolved");

        return $this;
    }

    public function selectTotal()
    {
        $this->selectField("total");

        return $this;
    }
}
