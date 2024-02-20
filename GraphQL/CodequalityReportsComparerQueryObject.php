<?php

namespace GraphQL\SchemaObject;

class CodequalityReportsComparerQueryObject extends QueryObject
{
    const OBJECT_NAME = "CodequalityReportsComparer";

    public function selectReport(CodequalityReportsComparerReportArgumentsObject $argsObject = null)
    {
        $object = new CodequalityReportsComparerReportQueryObject("report");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectStatus()
    {
        $this->selectField("status");

        return $this;
    }
}
