<?php

namespace GraphQL\SchemaObject;

class SentryErrorStackTraceContextQueryObject extends QueryObject
{
    const OBJECT_NAME = "SentryErrorStackTraceContext";

    public function selectCode()
    {
        $this->selectField("code");

        return $this;
    }

    public function selectLine()
    {
        $this->selectField("line");

        return $this;
    }
}
