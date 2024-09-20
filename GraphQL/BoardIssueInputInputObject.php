<?php

namespace GraphQL\SchemaObject;

class BoardIssueInputInputObject extends InputObject
{
    protected $labelName;
    protected $authorUsername;
    protected $myReactionEmoji;
    protected $iids;
    protected $milestoneTitle;
    protected $assigneeUsername;
    protected $releaseTag;
    protected $types;
    protected $milestoneWildcardId;
    protected $not;
    protected $or;
    protected $search;
    protected $assigneeWildcardId;
    protected $confidential;

    public function setLabelName(array $labelName)
    {
        $this->labelName = $labelName;

        return $this;
    }

    public function setAuthorUsername($authorUsername)
    {
        $this->authorUsername = $authorUsername;

        return $this;
    }

    public function setMyReactionEmoji($myReactionEmoji)
    {
        $this->myReactionEmoji = $myReactionEmoji;

        return $this;
    }

    public function setIids(array $iids)
    {
        $this->iids = $iids;

        return $this;
    }

    public function setMilestoneTitle($milestoneTitle)
    {
        $this->milestoneTitle = $milestoneTitle;

        return $this;
    }

    public function setAssigneeUsername(array $assigneeUsername)
    {
        $this->assigneeUsername = $assigneeUsername;

        return $this;
    }

    public function setReleaseTag($releaseTag)
    {
        $this->releaseTag = $releaseTag;

        return $this;
    }

    public function setTypes(array $types)
    {
        $this->types = $types;

        return $this;
    }

    public function setMilestoneWildcardId($milestoneWildcardId)
    {
        $this->milestoneWildcardId = $milestoneWildcardId;

        return $this;
    }

    public function setNot(NegatedBoardIssueInputInputObject $negatedBoardIssueInputInputObject)
    {
        $this->not = $negatedBoardIssueInputInputObject;

        return $this;
    }

    public function setOr(UnionedIssueFilterInputInputObject $unionedIssueFilterInputInputObject)
    {
        $this->or = $unionedIssueFilterInputInputObject;

        return $this;
    }

    public function setSearch($search)
    {
        $this->search = $search;

        return $this;
    }

    public function setAssigneeWildcardId($assigneeWildcardId)
    {
        $this->assigneeWildcardId = $assigneeWildcardId;

        return $this;
    }

    public function setConfidential($confidential)
    {
        $this->confidential = $confidential;

        return $this;
    }
}
