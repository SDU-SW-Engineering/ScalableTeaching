<?php

namespace GraphQL\SchemaObject;

use GraphQL\RawObject;

class MergeRequestParticipantAssignedMergeRequestsArgumentsObject extends ArgumentsObject
{
    protected $iids;
    protected $sourceBranches;
    protected $targetBranches;
    protected $state;
    protected $draft;
    protected $approved;
    protected $createdAfter;
    protected $createdBefore;
    protected $updatedAfter;
    protected $updatedBefore;
    protected $labels;
    protected $mergedAfter;
    protected $mergedBefore;
    protected $milestoneTitle;
    protected $sort;
    protected $not;
    protected $groupId;
    protected $projectPath;
    protected $projectId;
    protected $authorUsername;
    protected $reviewerUsername;
    protected $after;
    protected $before;
    protected $first;
    protected $last;

    public function setIids(array $iids)
    {
        $this->iids = $iids;

        return $this;
    }

    public function setSourceBranches(array $sourceBranches)
    {
        $this->sourceBranches = $sourceBranches;

        return $this;
    }

    public function setTargetBranches(array $targetBranches)
    {
        $this->targetBranches = $targetBranches;

        return $this;
    }

    public function setState($mergeRequestState)
    {
        $this->state = new RawObject($mergeRequestState);

        return $this;
    }

    public function setDraft($draft)
    {
        $this->draft = $draft;

        return $this;
    }

    public function setApproved($approved)
    {
        $this->approved = $approved;

        return $this;
    }

    public function setCreatedAfter($createdAfter)
    {
        $this->createdAfter = $createdAfter;

        return $this;
    }

    public function setCreatedBefore($createdBefore)
    {
        $this->createdBefore = $createdBefore;

        return $this;
    }

    public function setUpdatedAfter($updatedAfter)
    {
        $this->updatedAfter = $updatedAfter;

        return $this;
    }

    public function setUpdatedBefore($updatedBefore)
    {
        $this->updatedBefore = $updatedBefore;

        return $this;
    }

    public function setLabels(array $labels)
    {
        $this->labels = $labels;

        return $this;
    }

    public function setMergedAfter($mergedAfter)
    {
        $this->mergedAfter = $mergedAfter;

        return $this;
    }

    public function setMergedBefore($mergedBefore)
    {
        $this->mergedBefore = $mergedBefore;

        return $this;
    }

    public function setMilestoneTitle($milestoneTitle)
    {
        $this->milestoneTitle = $milestoneTitle;

        return $this;
    }

    public function setSort($mergeRequestSort)
    {
        $this->sort = new RawObject($mergeRequestSort);

        return $this;
    }

    public function setNot(MergeRequestsResolverNegatedParamsInputObject $mergeRequestsResolverNegatedParamsInputObject)
    {
        $this->not = $mergeRequestsResolverNegatedParamsInputObject;

        return $this;
    }

    public function setGroupId($groupId)
    {
        $this->groupId = $groupId;

        return $this;
    }

    public function setProjectPath($projectPath)
    {
        $this->projectPath = $projectPath;

        return $this;
    }

    public function setProjectId($projectId)
    {
        $this->projectId = $projectId;

        return $this;
    }

    public function setAuthorUsername($authorUsername)
    {
        $this->authorUsername = $authorUsername;

        return $this;
    }

    public function setReviewerUsername($reviewerUsername)
    {
        $this->reviewerUsername = $reviewerUsername;

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
