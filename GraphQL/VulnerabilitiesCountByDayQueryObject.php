<?php

namespace GraphQL\SchemaObject;

class VulnerabilitiesCountByDayQueryObject extends QueryObject
{
    const OBJECT_NAME = "VulnerabilitiesCountByDay";

    public function selectCritical()
    {
        $this->selectField("critical");

        return $this;
    }

    public function selectDate()
    {
        $this->selectField("date");

        return $this;
    }

    public function selectHigh()
    {
        $this->selectField("high");

        return $this;
    }

    public function selectInfo()
    {
        $this->selectField("info");

        return $this;
    }

    public function selectLow()
    {
        $this->selectField("low");

        return $this;
    }

    public function selectMedium()
    {
        $this->selectField("medium");

        return $this;
    }

    public function selectTotal()
    {
        $this->selectField("total");

        return $this;
    }

    public function selectUnknown()
    {
        $this->selectField("unknown");

        return $this;
    }
}
