<?php

namespace GraphQL\SchemaObject;

use GraphQL\RawObject;

class GroupProjectsArgumentsObject extends ArgumentsObject
{
    protected $includeSubgroups;
    protected $search;
    protected $sort;
    protected $ids;
    protected $hasCodeCoverage;
    protected $hasVulnerabilities;
    protected $after;
    protected $before;
    protected $first;
    protected $last;

    public function setIncludeSubgroups($includeSubgroups)
    {
        $this->includeSubgroups = $includeSubgroups;

        return $this;
    }

    public function setSearch($search)
    {
        $this->search = $search;

        return $this;
    }

    public function setSort($namespaceProjectSort)
    {
        $this->sort = new RawObject($namespaceProjectSort);

        return $this;
    }

    public function setIds(array $ids)
    {
        $this->ids = $ids;

        return $this;
    }

    public function setHasCodeCoverage($hasCodeCoverage)
    {
        $this->hasCodeCoverage = $hasCodeCoverage;

        return $this;
    }

    public function setHasVulnerabilities($hasVulnerabilities)
    {
        $this->hasVulnerabilities = $hasVulnerabilities;

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
