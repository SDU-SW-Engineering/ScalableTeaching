<?php

namespace GraphQL\SchemaObject;

class GroupVulnerabilitiesCountByDayArgumentsObject extends ArgumentsObject
{
    protected $startDate;
    protected $endDate;
    protected $after;
    protected $before;
    protected $first;
    protected $last;

    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

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
