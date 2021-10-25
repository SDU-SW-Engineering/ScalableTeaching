<?php

namespace GraphQL\SchemaObject;

class TestReportSummaryQueryObject extends QueryObject
{
    const OBJECT_NAME = "TestReportSummary";

    public function selectTestSuites(TestReportSummaryTestSuitesArgumentsObject $argsObject = null)
    {
        $object = new TestSuiteSummaryConnectionQueryObject("testSuites");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTotal(TestReportSummaryTotalArgumentsObject $argsObject = null)
    {
        $object = new TestReportTotalQueryObject("total");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
