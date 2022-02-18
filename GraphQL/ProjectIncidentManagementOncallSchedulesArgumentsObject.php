<?php

namespace GraphQL\SchemaObject;

class ProjectIncidentManagementOncallSchedulesArgumentsObject extends ArgumentsObject
{
    protected $iids;
    protected $after;
    protected $before;
    protected $first;
    protected $last;

    public function setIids(array $iids)
    {
        $this->iids = $iids;

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
