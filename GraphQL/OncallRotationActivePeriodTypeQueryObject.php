<?php

namespace GraphQL\SchemaObject;

class OncallRotationActivePeriodTypeQueryObject extends QueryObject
{
    const OBJECT_NAME = "OncallRotationActivePeriodType";

    public function selectEndTime()
    {
        $this->selectField("endTime");

        return $this;
    }

    public function selectStartTime()
    {
        $this->selectField("startTime");

        return $this;
    }
}
