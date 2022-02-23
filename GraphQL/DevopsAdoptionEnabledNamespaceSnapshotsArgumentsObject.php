<?php

namespace GraphQL\SchemaObject;

class DevopsAdoptionEnabledNamespaceSnapshotsArgumentsObject extends ArgumentsObject
{
    protected $endTimeBefore;
    protected $endTimeAfter;
    protected $after;
    protected $before;
    protected $first;
    protected $last;

    public function setEndTimeBefore($endTimeBefore)
    {
        $this->endTimeBefore = $endTimeBefore;

        return $this;
    }

    public function setEndTimeAfter($endTimeAfter)
    {
        $this->endTimeAfter = $endTimeAfter;

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
