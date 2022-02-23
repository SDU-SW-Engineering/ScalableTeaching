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
    protected $epicId;
    protected $iterationTitle;
    protected $weight;
    protected $iterationId;
    protected $not;
    protected $search;
    protected $assigneeWildcardId;
    protected $confidential;
    protected $epicWildcardId;
    protected $iterationWildcardId;
    protected $iterationCadenceId;
    protected $weightWildcardId;

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

    public function setNot(NegatedBoardIssueInputInputObject $negatedBoardIssueInputInputObject)
    {
        $this->not = $negatedBoardIssueInputInputObject;

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

    public function setEpicWildcardId($epicWildcardId)
    {
        $this->epicWildcardId = $epicWildcardId;

        return $this;
    }

    public function setIterationWildcardId($iterationWildcardId)
    {
        $this->iterationWildcardId = $iterationWildcardId;

        return $this;
    }

    public function setIterationCadenceId(array $iterationCadenceId)
    {
        $this->iterationCadenceId = $iterationCadenceId;

        return $this;
    }

    public function setWeightWildcardId($weightWildcardId)
    {
        $this->weightWildcardId = $weightWildcardId;

        return $this;
    }
}
