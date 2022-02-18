<?php

namespace GraphQL\SchemaObject;

class PipelineSecurityReportFindingsArgumentsObject extends ArgumentsObject
{
    protected $reportType;
    protected $severity;
    protected $scanner;
    protected $state;
    protected $after;
    protected $before;
    protected $first;
    protected $last;

    public function setReportType(array $reportType)
    {
        $this->reportType = $reportType;

        return $this;
    }

    public function setSeverity(array $severity)
    {
        $this->severity = $severity;

        return $this;
    }

    public function setScanner(array $scanner)
    {
        $this->scanner = $scanner;

        return $this;
    }

    public function setState(array $state)
    {
        $this->state = $state;

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
