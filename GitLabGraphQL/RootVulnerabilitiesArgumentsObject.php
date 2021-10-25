<?php

namespace GraphQL\SchemaObject;

use GraphQL\RawObject;

class RootVulnerabilitiesArgumentsObject extends ArgumentsObject
{
    protected $projectId;
    protected $reportType;
    protected $severity;
    protected $state;
    protected $scanner;
    protected $scannerId;
    protected $sort;
    protected $hasResolution;
    protected $hasIssues;
    protected $image;
    protected $after;
    protected $before;
    protected $first;
    protected $last;

    public function setProjectId(array $projectId)
    {
        $this->projectId = $projectId;

        return $this;
    }

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

    public function setState(array $state)
    {
        $this->state = $state;

        return $this;
    }

    public function setScanner(array $scanner)
    {
        $this->scanner = $scanner;

        return $this;
    }

    public function setScannerId(array $scannerId)
    {
        $this->scannerId = $scannerId;

        return $this;
    }

    public function setSort($vulnerabilitySort)
    {
        $this->sort = new RawObject($vulnerabilitySort);

        return $this;
    }

    public function setHasResolution($hasResolution)
    {
        $this->hasResolution = $hasResolution;

        return $this;
    }

    public function setHasIssues($hasIssues)
    {
        $this->hasIssues = $hasIssues;

        return $this;
    }

    public function setImage(array $image)
    {
        $this->image = $image;

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
