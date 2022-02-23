<?php

namespace GraphQL\SchemaObject;

class ProjectDastProfilesArgumentsObject extends ArgumentsObject
{
    protected $hasDastProfileSchedule;
    protected $after;
    protected $before;
    protected $first;
    protected $last;

    public function setHasDastProfileSchedule($hasDastProfileSchedule)
    {
        $this->hasDastProfileSchedule = $hasDastProfileSchedule;

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
