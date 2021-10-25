<?php

namespace GraphQL\SchemaObject;

class TestSuiteSummaryQueryObject extends QueryObject
{
    const OBJECT_NAME = "TestSuiteSummary";

    public function selectBuildIds()
    {
        $this->selectField("buildIds");

        return $this;
    }

    public function selectErrorCount()
    {
        $this->selectField("errorCount");

        return $this;
    }

    public function selectFailedCount()
    {
        $this->selectField("failedCount");

        return $this;
    }

    public function selectName()
    {
        $this->selectField("name");

        return $this;
    }

    public function selectSkippedCount()
    {
        $this->selectField("skippedCount");

        return $this;
    }

    public function selectSuccessCount()
    {
        $this->selectField("successCount");

        return $this;
    }

    public function selectSuiteError()
    {
        $this->selectField("suiteError");

        return $this;
    }

    public function selectTotalCount()
    {
        $this->selectField("totalCount");

        return $this;
    }

    public function selectTotalTime()
    {
        $this->selectField("totalTime");

        return $this;
    }
}
