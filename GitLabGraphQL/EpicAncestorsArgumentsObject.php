<?php

namespace GraphQL\SchemaObject;

use GraphQL\RawObject;

class EpicAncestorsArgumentsObject extends ArgumentsObject
{
    protected $timeframe;
    protected $search;
    protected $iid;
    protected $iids;
    protected $state;
    protected $in;
    protected $sort;
    protected $authorUsername;
    protected $labelName;
    protected $milestoneTitle;
    protected $iidStartsWith;
    protected $includeAncestorGroups;
    protected $includeDescendantGroups;
    protected $confidential;
    protected $myReactionEmoji;
    protected $not;
    protected $after;
    protected $before;
    protected $first;
    protected $last;

    public function setTimeframe(TimeframeInputObject $timeframeInputObject)
    {
        $this->timeframe = $timeframeInputObject;

        return $this;
    }

    public function setSearch($search)
    {
        $this->search = $search;

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

    public function setState($epicState)
    {
        $this->state = new RawObject($epicState);

        return $this;
    }

    public function setIn(array $in)
    {
        $this->in = $in;

        return $this;
    }

    public function setSort($epicSort)
    {
        $this->sort = new RawObject($epicSort);

        return $this;
    }

    public function setAuthorUsername($authorUsername)
    {
        $this->authorUsername = $authorUsername;

        return $this;
    }

    public function setLabelName(array $labelName)
    {
        $this->labelName = $labelName;

        return $this;
    }

    public function setMilestoneTitle($milestoneTitle)
    {
        $this->milestoneTitle = $milestoneTitle;

        return $this;
    }

    public function setIidStartsWith($iidStartsWith)
    {
        $this->iidStartsWith = $iidStartsWith;

        return $this;
    }

    public function setIncludeAncestorGroups($includeAncestorGroups)
    {
        $this->includeAncestorGroups = $includeAncestorGroups;

        return $this;
    }

    public function setIncludeDescendantGroups($includeDescendantGroups)
    {
        $this->includeDescendantGroups = $includeDescendantGroups;

        return $this;
    }

    public function setConfidential($confidential)
    {
        $this->confidential = $confidential;

        return $this;
    }

    public function setMyReactionEmoji($myReactionEmoji)
    {
        $this->myReactionEmoji = $myReactionEmoji;

        return $this;
    }

    public function setNot(NegatedEpicFilterInputInputObject $negatedEpicFilterInputInputObject)
    {
        $this->not = $negatedEpicFilterInputInputObject;

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
