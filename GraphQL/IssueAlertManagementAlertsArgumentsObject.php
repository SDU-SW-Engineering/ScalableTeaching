<?php

namespace GraphQL\SchemaObject;

use GraphQL\RawObject;

class IssueAlertManagementAlertsArgumentsObject extends ArgumentsObject
{
    protected $iid;
    protected $statuses;
    protected $sort;
    protected $domain;
    protected $search;
    protected $assigneeUsername;
    protected $after;
    protected $before;
    protected $first;
    protected $last;

    public function setIid($iid)
    {
        $this->iid = $iid;

        return $this;
    }

    public function setStatuses(array $statuses)
    {
        $this->statuses = $statuses;

        return $this;
    }

    public function setSort($alertManagementAlertSort)
    {
        $this->sort = new RawObject($alertManagementAlertSort);

        return $this;
    }

    public function setDomain($alertManagementDomainFilter)
    {
        $this->domain = new RawObject($alertManagementDomainFilter);

        return $this;
    }

    public function setSearch($search)
    {
        $this->search = $search;

        return $this;
    }

    public function setAssigneeUsername($assigneeUsername)
    {
        $this->assigneeUsername = $assigneeUsername;

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
