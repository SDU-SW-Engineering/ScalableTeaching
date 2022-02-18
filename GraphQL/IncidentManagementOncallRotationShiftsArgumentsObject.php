<?php

namespace GraphQL\SchemaObject;

class IncidentManagementOncallRotationShiftsArgumentsObject extends ArgumentsObject
{
    protected $startTime;
    protected $endTime;
    protected $after;
    protected $before;
    protected $first;
    protected $last;

    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;

        return $this;
    }

    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;

        return $this;
    }

    public function setAfter($after)
    {
        $this->after = $after;

        return $this;
    }

    public function setBefore($before)
    {
        $this->before = $before;

        return $this;
    }

    public function setFirst($first)
    {
        $this->first = $first;

        return $this;
    }

    public function setLast($last)
    {
        $this->last = $last;

        return $this;
    }
}
