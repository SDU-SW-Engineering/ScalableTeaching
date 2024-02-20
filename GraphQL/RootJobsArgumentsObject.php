<?php

namespace GraphQL\SchemaObject;

class RootJobsArgumentsObject extends ArgumentsObject
{
    protected $statuses;
    protected $after;
    protected $before;
    protected $first;
    protected $last;

    public function setStatuses(array $statuses)
    {
        $this->statuses = $statuses;

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
