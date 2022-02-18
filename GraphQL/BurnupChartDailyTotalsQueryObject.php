<?php

namespace GraphQL\SchemaObject;

class BurnupChartDailyTotalsQueryObject extends QueryObject
{
    const OBJECT_NAME = "BurnupChartDailyTotals";

    public function selectCompletedCount()
    {
        $this->selectField("completedCount");

        return $this;
    }

    public function selectCompletedWeight()
    {
        $this->selectField("completedWeight");

        return $this;
    }

    public function selectDate()
    {
        $this->selectField("date");

        return $this;
    }

    public function selectScopeCount()
    {
        $this->selectField("scopeCount");

        return $this;
    }

    public function selectScopeWeight()
    {
        $this->selectField("scopeWeight");

        return $this;
    }
}
