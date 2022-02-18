<?php

namespace GraphQL\SchemaObject;

class TimeboxReportQueryObject extends QueryObject
{
    const OBJECT_NAME = "TimeboxReport";

    public function selectBurnupTimeSeries(TimeboxReportBurnupTimeSeriesArgumentsObject $argsObject = null)
    {
        $object = new BurnupChartDailyTotalsQueryObject("burnupTimeSeries");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectStats(TimeboxReportStatsArgumentsObject $argsObject = null)
    {
        $object = new TimeReportStatsQueryObject("stats");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
