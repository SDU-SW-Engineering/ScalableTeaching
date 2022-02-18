<?php

namespace GraphQL\SchemaObject;

use GraphQL\RawObject;

class ProjectIssueStatusCountsArgumentsObject extends ArgumentsObject
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
    protected $releaseTag;
    protected $releaseTagWildcardId;

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
}
