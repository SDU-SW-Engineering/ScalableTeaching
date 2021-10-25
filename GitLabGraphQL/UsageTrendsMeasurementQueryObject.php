<?php

namespace GraphQL\SchemaObject;

class UsageTrendsMeasurementQueryObject extends QueryObject
{
    const OBJECT_NAME = "UsageTrendsMeasurement";

    public function selectCount()
    {
        $this->selectField("count");

        return $this;
    }

    public function selectIdentifier()
    {
        $this->selectField("identifier");

        return $this;
    }

    public function selectRecordedAt()
    {
        $this->selectField("recordedAt");

        return $this;
    }
}
