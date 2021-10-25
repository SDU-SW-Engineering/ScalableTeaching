<?php

namespace GraphQL\SchemaObject;

use GraphQL\RawObject;

class ProjectRequirementsArgumentsObject extends ArgumentsObject
{
    protected $sort;
    protected $state;
    protected $search;
    protected $authorUsername;
    protected $iid;
    protected $iids;
    protected $lastTestReportState;
    protected $after;
    protected $before;
    protected $first;
    protected $last;

    public function setSort($sort)
    {
        $this->sort = new RawObject($sort);

        return $this;
    }

    public function setState($requirementState)
    {
        $this->state = new RawObject($requirementState);

        return $this;
    }

    public function setSearch($search)
    {
        $this->search = $search;

        return $this;
    }

    public function setAuthorUsername(array $authorUsername)
    {
        $this->authorUsername = $authorUsername;

        return $this;
    }

    public function setIid($iid)
    {
        $this->iid = $iid;

        return $this;
    }

    public function setIids(array $iids)
    {
        $this->iids = $iids;

        return $this;
    }

    public function setLastTestReportState($requirementStatusFilter)
    {
        $this->lastTestReportState = new RawObject($requirementStatusFilter);

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
