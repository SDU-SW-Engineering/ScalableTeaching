<?php

namespace GraphQL\SchemaObject;

class IterationCadenceQueryObject extends QueryObject
{
    const OBJECT_NAME = "IterationCadence";

    public function selectActive()
    {
        $this->selectField("active");

        return $this;
    }

    public function selectAutomatic()
    {
        $this->selectField("automatic");

        return $this;
    }

    public function selectDescription()
    {
        $this->selectField("description");

        return $this;
    }

    public function selectDurationInWeeks()
    {
        $this->selectField("durationInWeeks");

        return $this;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectIterationsInAdvance()
    {
        $this->selectField("iterationsInAdvance");

        return $this;
    }

    public function selectRollOver()
    {
        $this->selectField("rollOver");

        return $this;
    }

    public function selectStartDate()
    {
        $this->selectField("startDate");

        return $this;
    }

    public function selectTitle()
    {
        $this->selectField("title");

        return $this;
    }
}
