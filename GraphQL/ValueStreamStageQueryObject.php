<?php

namespace GraphQL\SchemaObject;

class ValueStreamStageQueryObject extends QueryObject
{
    const OBJECT_NAME = "ValueStreamStage";

    public function selectCustom()
    {
        $this->selectField("custom");

        return $this;
    }

    public function selectEndEventIdentifier()
    {
        $this->selectField("endEventIdentifier");

        return $this;
    }

    public function selectHidden()
    {
        $this->selectField("hidden");

        return $this;
    }

    public function selectName()
    {
        $this->selectField("name");

        return $this;
    }

    public function selectStartEventIdentifier()
    {
        $this->selectField("startEventIdentifier");

        return $this;
    }
}
