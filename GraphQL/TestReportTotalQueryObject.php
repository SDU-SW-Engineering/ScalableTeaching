<?php

namespace GraphQL\SchemaObject;

class TestReportTotalQueryObject extends QueryObject
{
    const OBJECT_NAME = "TestReportTotal";

    public function selectCount()
    {
        $this->selectField("count");

        return $this;
    }

    public function selectError()
    {
        $this->selectField("error");

        return $this;
    }

    public function selectFailed()
    {
        $this->selectField("failed");

        return $this;
    }

    public function selectSkipped()
    {
        $this->selectField("skipped");

        return $this;
    }

    public function selectSuccess()
    {
        $this->selectField("success");

        return $this;
    }

    public function selectSuiteError()
    {
        $this->selectField("suiteError");

        return $this;
    }

    public function selectTime()
    {
        $this->selectField("time");

        return $this;
    }
}
