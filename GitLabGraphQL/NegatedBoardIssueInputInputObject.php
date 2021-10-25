<?php

namespace GraphQL\SchemaObject;

class NegatedBoardIssueInputInputObject extends InputObject
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
    protected $epicId;
    protected $iterationTitle;
    protected $weight;
    protected $iterationId;
    protected $iterationWildcardId;

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

    public function setEpicId($epicId)
    {
        $this->epicId = $epicId;

        return $this;
    }

    public function setIterationTitle($iterationTitle)
    {
        $this->iterationTitle = $iterationTitle;

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
