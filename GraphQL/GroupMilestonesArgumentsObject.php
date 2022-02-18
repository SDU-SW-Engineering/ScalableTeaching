<?php

namespace GraphQL\SchemaObject;

use GraphQL\RawObject;

class GroupMilestonesArgumentsObject extends ArgumentsObject
{
    protected $timeframe;
    protected $ids;
    protected $state;
    protected $title;
    protected $searchTitle;
    protected $containingDate;
    protected $sort;
    protected $includeAncestors;
    protected $includeDescendants;
    protected $after;
    protected $before;
    protected $first;
    protected $last;

    public function setTimeframe(TimeframeInputObject $timeframeInputObject)
    {
        $this->timeframe = $timeframeInputObject;

        return $this;
    }

    public function setIds(array $ids)
    {
        $this->ids = $ids;

        return $this;
    }

    public function setState($milestoneStateEnum)
    {
        $this->state = new RawObject($milestoneStateEnum);

        return $this;
    }

    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    public function setSearchTitle($searchTitle)
    {
        $this->searchTitle = $searchTitle;

        return $this;
    }

    public function setContainingDate($containingDate)
    {
        $this->containingDate = $containingDate;

        return $this;
    }

    public function setSort($milestoneSort)
    {
        $this->sort = new RawObject($milestoneSort);

        return $this;
    }

    public function setIncludeAncestors($includeAncestors)
    {
        $this->includeAncestors = $includeAncestors;

        return $this;
    }

    public function setIncludeDescendants($includeDescendants)
    {
        $this->includeDescendants = $includeDescendants;

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
