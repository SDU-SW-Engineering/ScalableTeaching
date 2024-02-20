<?php

namespace GraphQL\SchemaObject;

class NegatedIssueFilterInputInputObject extends InputObject
{
    protected $assigneeId;
    protected $assigneeUsernames;
    protected $authorUsername;
    protected $iids;
    protected $labelName;
    protected $milestoneTitle;
    protected $milestoneWildcardId;
    protected $myReactionEmoji;
    protected $releaseTag;
    protected $types;

    public function setAssigneeId($assigneeId)
    {
        $this->assigneeId = $assigneeId;

        return $this;
    }

    public function setAssigneeUsernames(array $assigneeUsernames)
    {
        $this->assigneeUsernames = $assigneeUsernames;

        return $this;
    }

    public function setAuthorUsername(array $authorUsername)
    {
        $this->authorUsername = $authorUsername;

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

    public function setMilestoneWildcardId($milestoneWildcardId)
    {
        $this->milestoneWildcardId = $milestoneWildcardId;

        return $this;
    }

    public function setMyReactionEmoji($myReactionEmoji)
    {
        $this->myReactionEmoji = $myReactionEmoji;

        return $this;
    }

    public function setReleaseTag(array $releaseTag)
    {
        $this->releaseTag = $releaseTag;

        return $this;
    }

    public function setTypes(array $types)
    {
        $this->types = $types;

        return $this;
    }
}
