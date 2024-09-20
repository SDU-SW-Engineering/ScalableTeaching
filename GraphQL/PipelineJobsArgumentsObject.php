<?php

namespace GraphQL\SchemaObject;

use GraphQL\RawObject;

class PipelineJobsArgumentsObject extends ArgumentsObject
{
    protected $securityReportTypes;
    protected $statuses;
    protected $retried;
    protected $whenExecuted;
    protected $jobKind;
    protected $after;
    protected $before;
    protected $first;
    protected $last;

    public function setSecurityReportTypes(array $securityReportTypes)
    {
        $this->securityReportTypes = $securityReportTypes;

        return $this;
    }

    public function setStatuses(array $statuses)
    {
        $this->statuses = $statuses;

        return $this;
    }

    public function setRetried($retried)
    {
        $this->retried = $retried;

        return $this;
    }

    public function setWhenExecuted(array $whenExecuted)
    {
        $this->whenExecuted = $whenExecuted;

        return $this;
    }

    public function setJobKind($ciJobKind)
    {
        $this->jobKind = new RawObject($ciJobKind);

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
