<?php

namespace GraphQL\SchemaObject;

use GraphQL\RawObject;

class GroupIterationsArgumentsObject extends ArgumentsObject
{
    protected $timeframe;
    protected $state;
    protected $title;
    protected $id;
    protected $iid;
    protected $includeAncestors;
    protected $iterationCadenceIds;
    protected $after;
    protected $before;
    protected $first;
    protected $last;

    public function setTimeframe(TimeframeInputObject $timeframeInputObject)
    {
        $this->timeframe = $timeframeInputObject;

        return $this;
    }

    public function setState($iterationState)
    {
        $this->state = new RawObject($iterationState);

        return $this;
    }

    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function setIid($iid)
    {
        $this->iid = $iid;

        return $this;
    }

    public function setIncludeAncestors($includeAncestors)
    {
        $this->includeAncestors = $includeAncestors;

        return $this;
    }

    public function setIterationCadenceIds(array $iterationCadenceIds)
    {
        $this->iterationCadenceIds = $iterationCadenceIds;

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
