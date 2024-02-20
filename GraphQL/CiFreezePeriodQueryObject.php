<?php

namespace GraphQL\SchemaObject;

class CiFreezePeriodQueryObject extends QueryObject
{
    const OBJECT_NAME = "CiFreezePeriod";

    public function selectCronTimezone()
    {
        $this->selectField("cronTimezone");

        return $this;
    }

    public function selectEndCron()
    {
        $this->selectField("endCron");

        return $this;
    }

    public function selectEndTime()
    {
        $this->selectField("endTime");

        return $this;
    }

    public function selectStartCron()
    {
        $this->selectField("startCron");

        return $this;
    }

    public function selectStartTime()
    {
        $this->selectField("startTime");

        return $this;
    }

    public function selectStatus()
    {
        $this->selectField("status");

        return $this;
    }
}
