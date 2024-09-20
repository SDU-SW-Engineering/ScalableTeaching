<?php

namespace GraphQL\SchemaObject;

class PipelineScheduleVariableQueryObject extends QueryObject
{
    const OBJECT_NAME = "PipelineScheduleVariable";

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectKey()
    {
        $this->selectField("key");

        return $this;
    }

    public function selectRaw()
    {
        $this->selectField("raw");

        return $this;
    }

    public function selectValue()
    {
        $this->selectField("value");

        return $this;
    }

    public function selectVariableType()
    {
        $this->selectField("variableType");

        return $this;
    }
}
