<?php

namespace GraphQL\SchemaObject;

use GraphQL\RawObject;

class RootUsageTrendsMeasurementsArgumentsObject extends ArgumentsObject
{
    protected $identifier;
    protected $recordedAfter;
    protected $recordedBefore;
    protected $after;
    protected $before;
    protected $first;
    protected $last;

    public function setIdentifier($measurementIdentifier)
    {
        $this->identifier = new RawObject($measurementIdentifier);

        return $this;
    }

    public function setRecordedAfter($recordedAfter)
    {
        $this->recordedAfter = $recordedAfter;

        return $this;
    }

    public function setRecordedBefore($recordedBefore)
    {
        $this->recordedBefore = $recordedBefore;

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
