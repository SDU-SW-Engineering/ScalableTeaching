<?php

namespace GraphQL\SchemaObject;

class MergeRequestQueryObject extends QueryObject
{
    const OBJECT_NAME = "MergeRequest";

    public function selectAllowCollaboration()
    {
        $this->selectField("allowCollaboration");

        return $this;
    }

    public function selectApprovalState(MergeRequestApprovalStateArgumentsObject $argsObject = null)
    {
        $object = new MergeRequestApprovalStateQueryObject("approvalState");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectApprovalsLeft()
    {
        $this->selectField("approvalsLeft");

        return $this;
    }

    public function selectApprovalsRequired()
    {
        $this->selectField("approvalsRequired");

        return $this;
    }

    public function selectApproved()
    {
        $this->selectField("approved");

        return $this;
    }

    public function selectApprovedBy(MergeRequestApprovedByArgumentsObject $argsObject = null)
    {
        $object = new UserCoreConnectionQueryObject("approvedBy");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectAssignees(MergeRequestAssigneesArgumentsObject $argsObject = null)
    {
        $object = new MergeRequestAssigneeConnectionQueryObject("assignees");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectAuthor(MergeRequestAuthorArgumentsObject $argsObject = null)
    {
        $object = new UserCoreQueryObject("author");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectAutoMergeEnabled()
    {
        $this->selectField("autoMergeEnabled");

        return $this;
    }

    public function selectAutoMergeStrategy()
    {
        $this->selectField("autoMergeStrategy");

        return $this;
    }

    public function selectAvailableAutoMergeStrategies()
    {
        $this->selectField("availableAutoMergeStrategies");

        return $this;
    }

    public function selectCommitCount()
    {
        $this->selectField("commitCount");

        return $this;
    }

    public function selectCommitsWithoutMergeCommits(MergeRequestCommitsWithoutMergeCommitsArgumentsObject $argsObject = null)
    {
        $object = new CommitConnectionQueryObject("commitsWithoutMergeCommits");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectConflicts()
    {
        $this->selectField("conflicts");

        return $this;
    }

    public function selectCreatedAt()
    {
        $this->selectField("createdAt");

        return $this;
    }

    public function selectCurrentUserTodos(MergeRequestCurrentUserTodosArgumentsObject $argsObject = null)
    {
        $object = new TodoConnectionQueryObject("currentUserTodos");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectDefaultMergeCommitMessage()
    {
        $this->selectField("defaultMergeCommitMessage");

        return $this;
    }

    public function selectDefaultMergeCommitMessageWithDescription()
    {
        $this->selectField("defaultMergeCommitMessageWithDescription");

        return $this;
    }

    public function selectDefaultSquashCommitMessage()
    {
        $this->selectField("defaultSquashCommitMessage");

        return $this;
    }

    public function selectDescription()
    {
        $this->selectField("description");

        return $this;
    }

    public function selectDescriptionHtml()
    {
        $this->selectField("descriptionHtml");

        return $this;
    }

    public function selectDiffHeadSha()
    {
        $this->selectField("diffHeadSha");

        return $this;
    }

    public function selectDiffRefs(MergeRequestDiffRefsArgumentsObject $argsObject = null)
    {
        $object = new DiffRefsQueryObject("diffRefs");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectDiffStats(MergeRequestDiffStatsArgumentsObject $argsObject = null)
    {
        $object = new DiffStatsQueryObject("diffStats");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectDiffStatsSummary(MergeRequestDiffStatsSummaryArgumentsObject $argsObject = null)
    {
        $object = new DiffStatsSummaryQueryObject("diffStatsSummary");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectDiscussionLocked()
    {
        $this->selectField("discussionLocked");

        return $this;
    }

    public function selectDiscussions(MergeRequestDiscussionsArgumentsObject $argsObject = null)
    {
        $object = new DiscussionConnectionQueryObject("discussions");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectDivergedFromTargetBranch()
    {
        $this->selectField("divergedFromTargetBranch");

        return $this;
    }

    public function selectDownvotes()
    {
        $this->selectField("downvotes");

        return $this;
    }

    public function selectDraft()
    {
        $this->selectField("draft");

        return $this;
    }

    public function selectForceRemoveSourceBranch()
    {
        $this->selectField("forceRemoveSourceBranch");

        return $this;
    }

    public function selectHasCi()
    {
        $this->selectField("hasCi");

        return $this;
    }

    public function selectHasSecurityReports()
    {
        $this->selectField("hasSecurityReports");

        return $this;
    }

    public function selectHeadPipeline(MergeRequestHeadPipelineArgumentsObject $argsObject = null)
    {
        $object = new PipelineQueryObject("headPipeline");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectHumanTimeEstimate()
    {
        $this->selectField("humanTimeEstimate");

        return $this;
    }

    public function selectHumanTotalTimeSpent()
    {
        $this->selectField("humanTotalTimeSpent");

        return $this;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectIid()
    {
        $this->selectField("iid");

        return $this;
    }

    public function selectInProgressMergeCommitSha()
    {
        $this->selectField("inProgressMergeCommitSha");

        return $this;
    }

    public function selectLabels(MergeRequestLabelsArgumentsObject $argsObject = null)
    {
        $object = new LabelConnectionQueryObject("labels");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectMergeCommitSha()
    {
        $this->selectField("mergeCommitSha");

        return $this;
    }

    public function selectMergeError()
    {
        $this->selectField("mergeError");

        return $this;
    }

    public function selectMergeOngoing()
    {
        $this->selectField("mergeOngoing");

        return $this;
    }

    /**
     * @deprecated This was renamed. Please use `MergeRequest.mergeStatusEnum`. Deprecated in 14.0.
     */
    public function selectMergeStatus()
    {
        $this->selectField("mergeStatus");

        return $this;
    }

    public function selectMergeStatusEnum()
    {
        $this->selectField("mergeStatusEnum");

        return $this;
    }

    public function selectMergeTrainsCount()
    {
        $this->selectField("mergeTrainsCount");

        return $this;
    }

    public function selectMergeUser(MergeRequestMergeUserArgumentsObject $argsObject = null)
    {
        $object = new UserCoreQueryObject("mergeUser");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectMergeWhenPipelineSucceeds()
    {
        $this->selectField("mergeWhenPipelineSucceeds");

        return $this;
    }

    public function selectMergeable()
    {
        $this->selectField("mergeable");

        return $this;
    }

    public function selectMergeableDiscussionsState()
    {
        $this->selectField("mergeableDiscussionsState");

        return $this;
    }

    public function selectMergedAt()
    {
        $this->selectField("mergedAt");

        return $this;
    }

    public function selectMilestone(MergeRequestMilestoneArgumentsObject $argsObject = null)
    {
        $object = new MilestoneQueryObject("milestone");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNotes(MergeRequestNotesArgumentsObject $argsObject = null)
    {
        $object = new NoteConnectionQueryObject("notes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectParticipants(MergeRequestParticipantsArgumentsObject $argsObject = null)
    {
        $object = new UserCoreConnectionQueryObject("participants");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPipelines(MergeRequestPipelinesArgumentsObject $argsObject = null)
    {
        $object = new PipelineConnectionQueryObject("pipelines");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectProject(MergeRequestProjectArgumentsObject $argsObject = null)
    {
        $object = new ProjectQueryObject("project");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectProjectId()
    {
        $this->selectField("projectId");

        return $this;
    }

    public function selectRebaseCommitSha()
    {
        $this->selectField("rebaseCommitSha");

        return $this;
    }

    public function selectRebaseInProgress()
    {
        $this->selectField("rebaseInProgress");

        return $this;
    }

    public function selectReference()
    {
        $this->selectField("reference");

        return $this;
    }

    public function selectReviewers(MergeRequestReviewersArgumentsObject $argsObject = null)
    {
        $object = new MergeRequestReviewerConnectionQueryObject("reviewers");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSecurityAutoFix()
    {
        $this->selectField("securityAutoFix");

        return $this;
    }

    public function selectSecurityReportsUpToDateOnTargetBranch()
    {
        $this->selectField("securityReportsUpToDateOnTargetBranch");

        return $this;
    }

    public function selectShouldBeRebased()
    {
        $this->selectField("shouldBeRebased");

        return $this;
    }

    public function selectShouldRemoveSourceBranch()
    {
        $this->selectField("shouldRemoveSourceBranch");

        return $this;
    }

    public function selectSourceBranch()
    {
        $this->selectField("sourceBranch");

        return $this;
    }

    public function selectSourceBranchExists()
    {
        $this->selectField("sourceBranchExists");

        return $this;
    }

    public function selectSourceBranchProtected()
    {
        $this->selectField("sourceBranchProtected");

        return $this;
    }

    public function selectSourceProject(MergeRequestSourceProjectArgumentsObject $argsObject = null)
    {
        $object = new ProjectQueryObject("sourceProject");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSourceProjectId()
    {
        $this->selectField("sourceProjectId");

        return $this;
    }

    public function selectSquash()
    {
        $this->selectField("squash");

        return $this;
    }

    public function selectSquashOnMerge()
    {
        $this->selectField("squashOnMerge");

        return $this;
    }

    public function selectState()
    {
        $this->selectField("state");

        return $this;
    }

    public function selectSubscribed()
    {
        $this->selectField("subscribed");

        return $this;
    }

    public function selectTargetBranch()
    {
        $this->selectField("targetBranch");

        return $this;
    }

    public function selectTargetBranchExists()
    {
        $this->selectField("targetBranchExists");

        return $this;
    }

    public function selectTargetProject(MergeRequestTargetProjectArgumentsObject $argsObject = null)
    {
        $object = new ProjectQueryObject("targetProject");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTargetProjectId()
    {
        $this->selectField("targetProjectId");

        return $this;
    }

    public function selectTaskCompletionStatus(MergeRequestTaskCompletionStatusArgumentsObject $argsObject = null)
    {
        $object = new TaskCompletionStatusQueryObject("taskCompletionStatus");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTimeEstimate()
    {
        $this->selectField("timeEstimate");

        return $this;
    }

    public function selectTimelogs(MergeRequestTimelogsArgumentsObject $argsObject = null)
    {
        $object = new TimelogConnectionQueryObject("timelogs");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTitle()
    {
        $this->selectField("title");

        return $this;
    }

    public function selectTitleHtml()
    {
        $this->selectField("titleHtml");

        return $this;
    }

    public function selectTotalTimeSpent()
    {
        $this->selectField("totalTimeSpent");

        return $this;
    }

    public function selectUpdatedAt()
    {
        $this->selectField("updatedAt");

        return $this;
    }

    public function selectUpvotes()
    {
        $this->selectField("upvotes");

        return $this;
    }

    public function selectUserDiscussionsCount()
    {
        $this->selectField("userDiscussionsCount");

        return $this;
    }

    public function selectUserNotesCount()
    {
        $this->selectField("userNotesCount");

        return $this;
    }

    public function selectUserPermissions(MergeRequestUserPermissionsArgumentsObject $argsObject = null)
    {
        $object = new MergeRequestPermissionsQueryObject("userPermissions");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectWebUrl()
    {
        $this->selectField("webUrl");

        return $this;
    }

    /**
     * @deprecated Use `draft`. Deprecated in 13.12.
     */
    public function selectWorkInProgress()
    {
        $this->selectField("workInProgress");

        return $this;
    }
}
