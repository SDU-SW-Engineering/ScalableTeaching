<?php

namespace GraphQL\SchemaObject;

use GraphQL\RawObject;

class ProjectPipelineSchedulesArgumentsObject extends ArgumentsObject
{
    protected $status;
    protected $ids;
    protected $after;
    protected $before;
    protected $first;
    protected $last;

    public function setStatus($pipelineScheduleStatus)
    {
        $this->status = new RawObject($pipelineScheduleStatus);

        return $this;
    }

    public function setIds(array $ids)
    {
        $this->ids = $ids;

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
