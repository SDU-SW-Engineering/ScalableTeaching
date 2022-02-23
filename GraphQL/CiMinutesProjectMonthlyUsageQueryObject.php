<?php

namespace GraphQL\SchemaObject;

class CiMinutesProjectMonthlyUsageQueryObject extends QueryObject
{
    const OBJECT_NAME = "CiMinutesProjectMonthlyUsage";

    public function selectMinutes()
    {
        $this->selectField("minutes");

        return $this;
    }

    public function selectName()
    {
        $this->selectField("name");

        return $this;
    }
}
