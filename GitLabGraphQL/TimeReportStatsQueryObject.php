<?php

namespace GraphQL\SchemaObject;

class TimeReportStatsQueryObject extends QueryObject
{
    const OBJECT_NAME = "TimeReportStats";

    public function selectComplete(TimeReportStatsCompleteArgumentsObject $argsObject = null)
    {
        $object = new TimeboxMetricsQueryObject("complete");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectIncomplete(TimeReportStatsIncompleteArgumentsObject $argsObject = null)
    {
        $object = new TimeboxMetricsQueryObject("incomplete");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTotal(TimeReportStatsTotalArgumentsObject $argsObject = null)
    {
        $object = new TimeboxMetricsQueryObject("total");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
