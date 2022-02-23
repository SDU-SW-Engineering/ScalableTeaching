<?php

namespace GraphQL\SchemaObject;

class NegatedIssueFilterInputInputObject extends InputObject
{
    protected $iids;
    protected $labelName;
    protected $milestoneTitle;
    protected $releaseTag;
    protected $authorUsername;
    protected $assigneeUsernames;
    protected $assigneeId;
    protected $milestoneWildcardId;
    protected $myReactionEmoji;
    protected $types;
    protected $epicId;
    protected $weight;
    protected $iterationId;
    protected $iterationWildcardId;

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

    public function setReleaseTag(array $releaseTag)
    {
        $this->releaseTag = $releaseTag;

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

    public function setTypes(array $types)
    {
        $this->types = $types;

        return $this;
    }

    public function setEpicId($epicId)
    {
        $this->epicId = $epicId;

        return $this;
    }

    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    public function setIterationId(array $iterationId)
    {
        $this->iterationId = $iterationId;

        return $this;
    }

    public function setIterationWildcardId($iterationWildcardId)
    {
        $this->iterationWildcardId = $iterationWildcardId;

        return $this;
    }
}
