<?php

namespace GraphQL\SchemaObject;

class DoraMetricQueryObject extends QueryObject
{
    const OBJECT_NAME = "DoraMetric";

    public function selectDate()
    {
        $this->selectField("date");

        return $this;
    }

    public function selectValue()
    {
        $this->selectField("value");

        return $this;
    }
}
