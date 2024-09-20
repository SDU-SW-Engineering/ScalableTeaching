<?php

namespace GraphQL\SchemaObject;

use GraphQL\RawObject;

class AutocompletedUserTimelogsArgumentsObject extends ArgumentsObject
{
    protected $startDate;
    protected $endDate;
    protected $startTime;
    protected $endTime;
    protected $projectId;
    protected $groupId;
    protected $username;
    protected $sort;
    protected $after;
    protected $before;
    protected $first;
    protected $last;

    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;

        return $this;
    }

    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;

        return $this;
    }

    public function setProjectId($projectId)
    {
        $this->projectId = $projectId;

        return $this;
    }

    public function setGroupId($groupId)
    {
        $this->groupId = $groupId;

        return $this;
    }

    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    public function setSort($timelogSort)
    {
        $this->sort = new RawObject($timelogSort);

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
