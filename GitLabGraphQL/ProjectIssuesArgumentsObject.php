<?php

namespace GraphQL\SchemaObject;

use GraphQL\RawObject;

class ProjectIssuesArgumentsObject extends ArgumentsObject
{
    protected $search;
    protected $iid;
    protected $iids;
    protected $labelName;
    protected $milestoneTitle;
    protected $authorUsername;
    protected $assigneeUsernames;
    protected $assigneeId;
    protected $createdBefore;
    protected $createdAfter;
    protected $updatedBefore;
    protected $updatedAfter;
    protected $closedBefore;
    protected $closedAfter;
    protected $types;
    protected $milestoneWildcardId;
    protected $myReactionEmoji;
    protected $confidential;
    protected $not;
    protected $state;
    protected $sort;
    protected $iterationId;
    protected $iterationWildcardId;
    protected $epicId;
    protected $includeSubepics;
    protected $weight;
    protected $releaseTag;
    protected $releaseTagWildcardId;
    protected $after;
    protected $before;
    protected $first;
    protected $last;

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

    public function setLabelName(array $labelName)
    {
        $this->labelName = $labelName;

        return $this;
    }

    public function setMilestoneTitle(array $milestoneTitle)
    {
        $this->milestoneTitle = $milestoneTitle;

        return $this;
    }

    public function setAuthorUsername($authorUsername)
    {
        $this->authorUsername = $authorUsername;

        return $this;
    }

    public function setAssigneeUsernames(array $assigneeUsernames)
    {
        $this->assigneeUsernames = $assigneeUsernames;

        return $this;
    }

    public function setAssigneeId($assigneeId)
    {
        $this->assigneeId = $assigneeId;

        return $this;
    }

    public function setCreatedBefore($createdBefore)
    {
        $this->createdBefore = $createdBefore;

        return $this;
    }

    public function setCreatedAfter($createdAfter)
    {
        $this->createdAfter = $createdAfter;

        return $this;
    }

    public function setUpdatedBefore($updatedBefore)
    {
        $this->updatedBefore = $updatedBefore;

        return $this;
    }

    public function setUpdatedAfter($updatedAfter)
    {
        $this->updatedAfter = $updatedAfter;

        return $this;
    }

    public function setClosedBefore($closedBefore)
    {
        $this->closedBefore = $closedBefore;

        return $this;
    }

    public function setClosedAfter($closedAfter)
    {
        $this->closedAfter = $closedAfter;

        return $this;
    }

    public function setTypes(array $types)
    {
        $this->types = $types;

        return $this;
    }

    public function setMilestoneWildcardId($milestoneWildcardId)
    {
        $this->milestoneWildcardId = new RawObject($milestoneWildcardId);

        return $this;
    }

    public function setMyReactionEmoji($myReactionEmoji)
    {
        $this->myReactionEmoji = $myReactionEmoji;

        return $this;
    }

    public function setConfidential($confidential)
    {
        $this->confidential = $confidential;

        return $this;
    }

    public function setNot(NegatedIssueFilterInputInputObject $negatedIssueFilterInputInputObject)
    {
        $this->not = $negatedIssueFilterInputInputObject;

        return $this;
    }

    public function setState($issuableState)
    {
        $this->state = new RawObject($issuableState);

        return $this;
    }

    public function setSort($issueSort)
    {
        $this->sort = new RawObject($issueSort);

        return $this;
    }

    public function setIterationId(array $iterationId)
    {
        $this->iterationId = $iterationId;

        return $this;
    }

    public function setIterationWildcardId($iterationWildcardId)
    {
        $this->iterationWildcardId = new RawObject($iterationWildcardId);

        return $this;
    }

    public function setEpicId($epicId)
    {
        $this->epicId = $epicId;

        return $this;
    }

    public function setIncludeSubepics($includeSubepics)
    {
        $this->includeSubepics = $includeSubepics;

        return $this;
    }

    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    public function setReleaseTag(array $releaseTag)
    {
        $this->releaseTag = $releaseTag;

        return $this;
    }

    public function setReleaseTagWildcardId($releaseTagWildcardId)
    {
        $this->releaseTagWildcardId = new RawObject($releaseTagWildcardId);

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
