<?php

namespace GraphQL\SchemaObject;

class TestSuiteQueryObject extends QueryObject
{
    const OBJECT_NAME = "TestSuite";

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

    public function selectTestCases(TestSuiteTestCasesArgumentsObject $argsObject = null)
    {
        $object = new TestCaseConnectionQueryObject("testCases");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
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
