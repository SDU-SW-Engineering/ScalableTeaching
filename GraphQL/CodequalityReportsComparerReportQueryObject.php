<?php

namespace GraphQL\SchemaObject;

class CodequalityReportsComparerReportQueryObject extends QueryObject
{
    const OBJECT_NAME = "CodequalityReportsComparerReport";

    public function selectExistingErrors(CodequalityReportsComparerReportExistingErrorsArgumentsObject $argsObject = null)
    {
        $object = new CodequalityReportsComparerReportDegradationQueryObject("existingErrors");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNewErrors(CodequalityReportsComparerReportNewErrorsArgumentsObject $argsObject = null)
    {
        $object = new CodequalityReportsComparerReportDegradationQueryObject("newErrors");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectResolvedErrors(CodequalityReportsComparerReportResolvedErrorsArgumentsObject $argsObject = null)
    {
        $object = new CodequalityReportsComparerReportDegradationQueryObject("resolvedErrors");
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

    public function selectSummary(CodequalityReportsComparerReportSummaryArgumentsObject $argsObject = null)
    {
        $object = new CodequalityReportsComparerReportSummaryQueryObject("summary");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
