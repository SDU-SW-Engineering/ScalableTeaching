<?php

namespace GraphQL\SchemaObject;

class GroupCodeCoverageActivitiesArgumentsObject extends ArgumentsObject
{
    protected $startDate;
    protected $after;
    protected $before;
    protected $first;
    protected $last;

    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

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
