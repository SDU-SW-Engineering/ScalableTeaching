<?php

namespace GraphQL\SchemaObject;

class TimeboxMetricsQueryObject extends QueryObject
{
    const OBJECT_NAME = "TimeboxMetrics";

    public function selectCount()
    {
        $this->selectField("count");

        return $this;
    }

    public function selectWeight()
    {
        $this->selectField("weight");

        return $this;
    }
}
