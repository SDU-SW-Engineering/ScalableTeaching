<?php

namespace GraphQL\SchemaObject;

class IssueQueryObject extends QueryObject
{
    const OBJECT_NAME = "Issue";

    public function selectAlertManagementAlert(IssueAlertManagementAlertArgumentsObject $argsObject = null)
    {
        $object = new AlertManagementAlertQueryObject("alertManagementAlert");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectAssignees(IssueAssigneesArgumentsObject $argsObject = null)
    {
        $object = new UserCoreConnectionQueryObject("assignees");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectAuthor(IssueAuthorArgumentsObject $argsObject = null)
    {
        $object = new UserCoreQueryObject("author");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectBlocked()
    {
        $this->selectField("blocked");

        return $this;
    }

    public function selectBlockedByCount()
    {
        $this->selectField("blockedByCount");

        return $this;
    }

    public function selectBlockedByIssues(IssueBlockedByIssuesArgumentsObject $argsObject = null)
    {
        $object = new IssueConnectionQueryObject("blockedByIssues");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectBlockingCount()
    {
        $this->selectField("blockingCount");

        return $this;
    }

    public function selectClosedAt()
    {
        $this->selectField("closedAt");

        return $this;
    }

    public function selectConfidential()
    {
        $this->selectField("confidential");

        return $this;
    }

    public function selectCreateNoteEmail()
    {
        $this->selectField("createNoteEmail");

        return $this;
    }

    public function selectCreatedAt()
    {
        $this->selectField("createdAt");

        return $this;
    }

    public function selectCurrentUserTodos(IssueCurrentUserTodosArgumentsObject $argsObject = null)
    {
        $object = new TodoConnectionQueryObject("currentUserTodos");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCustomerRelationsContacts(IssueCustomerRelationsContactsArgumentsObject $argsObject = null)
    {
        $object = new CustomerRelationsContactConnectionQueryObject("customerRelationsContacts");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
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

    public function selectDesignCollection(IssueDesignCollectionArgumentsObject $argsObject = null)
    {
        $object = new DesignCollectionQueryObject("designCollection");
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

    public function selectDiscussions(IssueDiscussionsArgumentsObject $argsObject = null)
    {
        $object = new DiscussionConnectionQueryObject("discussions");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectDownvotes()
    {
        $this->selectField("downvotes");

        return $this;
    }

    public function selectDueDate()
    {
        $this->selectField("dueDate");

        return $this;
    }

    public function selectEmailsDisabled()
    {
        $this->selectField("emailsDisabled");

        return $this;
    }

    public function selectEpic(IssueEpicArgumentsObject $argsObject = null)
    {
        $object = new EpicQueryObject("epic");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectEscalationPolicy(IssueEscalationPolicyArgumentsObject $argsObject = null)
    {
        $object = new EscalationPolicyTypeQueryObject("escalationPolicy");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectEscalationStatus()
    {
        $this->selectField("escalationStatus");

        return $this;
    }

    public function selectHealthStatus()
    {
        $this->selectField("healthStatus");

        return $this;
    }

    public function selectHidden()
    {
        $this->selectField("hidden");

        return $this;
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

    public function selectIteration(IssueIterationArgumentsObject $argsObject = null)
    {
        $object = new IterationQueryObject("iteration");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectLabels(IssueLabelsArgumentsObject $argsObject = null)
    {
        $object = new LabelConnectionQueryObject("labels");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectMergeRequestsCount()
    {
        $this->selectField("mergeRequestsCount");

        return $this;
    }

    public function selectMetricImages(IssueMetricImagesArgumentsObject $argsObject = null)
    {
        $object = new MetricImageQueryObject("metricImages");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectMilestone(IssueMilestoneArgumentsObject $argsObject = null)
    {
        $object = new MilestoneQueryObject("milestone");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectMoved()
    {
        $this->selectField("moved");

        return $this;
    }

    public function selectMovedTo(IssueMovedToArgumentsObject $argsObject = null)
    {
        $object = new IssueQueryObject("movedTo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNotes(IssueNotesArgumentsObject $argsObject = null)
    {
        $object = new NoteConnectionQueryObject("notes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectParticipants(IssueParticipantsArgumentsObject $argsObject = null)
    {
        $object = new UserCoreConnectionQueryObject("participants");
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

    public function selectReference()
    {
        $this->selectField("reference");

        return $this;
    }

    public function selectRelativePosition()
    {
        $this->selectField("relativePosition");

        return $this;
    }

    public function selectSeverity()
    {
        $this->selectField("severity");

        return $this;
    }

    public function selectSlaDueAt()
    {
        $this->selectField("slaDueAt");

        return $this;
    }

    public function selectState()
    {
        $this->selectField("state");

        return $this;
    }

    public function selectStatusPagePublishedIncident()
    {
        $this->selectField("statusPagePublishedIncident");

        return $this;
    }

    public function selectSubscribed()
    {
        $this->selectField("subscribed");

        return $this;
    }

    public function selectTaskCompletionStatus(IssueTaskCompletionStatusArgumentsObject $argsObject = null)
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

    public function selectTimelogs(IssueTimelogsArgumentsObject $argsObject = null)
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

    public function selectType()
    {
        $this->selectField("type");

        return $this;
    }

    public function selectUpdatedAt()
    {
        $this->selectField("updatedAt");

        return $this;
    }

    public function selectUpdatedBy(IssueUpdatedByArgumentsObject $argsObject = null)
    {
        $object = new UserCoreQueryObject("updatedBy");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
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

    public function selectUserPermissions(IssueUserPermissionsArgumentsObject $argsObject = null)
    {
        $object = new IssuePermissionsQueryObject("userPermissions");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectWebPath()
    {
        $this->selectField("webPath");

        return $this;
    }

    public function selectWebUrl()
    {
        $this->selectField("webUrl");

        return $this;
    }

    public function selectWeight()
    {
        $this->selectField("weight");

        return $this;
    }
}
