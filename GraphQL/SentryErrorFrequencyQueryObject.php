<?php

namespace GraphQL\SchemaObject;

class SentryErrorFrequencyQueryObject extends QueryObject
{
    const OBJECT_NAME = "SentryErrorFrequency";

    public function selectCount()
    {
        $this->selectField("count");

        return $this;
    }

    public function selectTime()
    {
        $this->selectField("time");

        return $this;
    }
}
