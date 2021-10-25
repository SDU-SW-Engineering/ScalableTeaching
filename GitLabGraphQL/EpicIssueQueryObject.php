<?php

namespace GraphQL\SchemaObject;

class EpicIssueQueryObject extends QueryObject
{
    const OBJECT_NAME = "EpicIssue";

    public function selectAlertManagementAlert(EpicIssueAlertManagementAlertArgumentsObject $argsObject = null)
    {
        $object = new AlertManagementAlertQueryObject("alertManagementAlert");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectAssignees(EpicIssueAssigneesArgumentsObject $argsObject = null)
    {
        $object = new UserCoreConnectionQueryObject("assignees");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectAuthor(EpicIssueAuthorArgumentsObject $argsObject = null)
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

    public function selectBlockedByIssues(EpicIssueBlockedByIssuesArgumentsObject $argsObject = null)
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

    public function selectCurrentUserTodos(EpicIssueCurrentUserTodosArgumentsObject $argsObject = null)
    {
        $object = new TodoConnectionQueryObject("currentUserTodos");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCustomerRelationsContacts(EpicIssueCustomerRelationsContactsArgumentsObject $argsObject = null)
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

    public function selectDesignCollection(EpicIssueDesignCollectionArgumentsObject $argsObject = null)
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

    public function selectDiscussions(EpicIssueDiscussionsArgumentsObject $argsObject = null)
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

    public function selectEpic(EpicIssueEpicArgumentsObject $argsObject = null)
    {
        $object = new EpicQueryObject("epic");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectEpicIssueId()
    {
        $this->selectField("epicIssueId");

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

    public function selectIteration(EpicIssueIterationArgumentsObject $argsObject = null)
    {
        $object = new IterationQueryObject("iteration");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectLabels(EpicIssueLabelsArgumentsObject $argsObject = null)
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

    public function selectMetricImages(EpicIssueMetricImagesArgumentsObject $argsObject = null)
    {
        $object = new MetricImageQueryObject("metricImages");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectMilestone(EpicIssueMilestoneArgumentsObject $argsObject = null)
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

    public function selectMovedTo(EpicIssueMovedToArgumentsObject $argsObject = null)
    {
        $object = new IssueQueryObject("movedTo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNotes(EpicIssueNotesArgumentsObject $argsObject = null)
    {
        $object = new NoteConnectionQueryObject("notes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectParticipants(EpicIssueParticipantsArgumentsObject $argsObject = null)
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

    public function selectRelationPath()
    {
        $this->selectField("relationPath");

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

    public function selectTaskCompletionStatus(EpicIssueTaskCompletionStatusArgumentsObject $argsObject = null)
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

    public function selectTimelogs(EpicIssueTimelogsArgumentsObject $argsObject = null)
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

    public function selectUpdatedBy(EpicIssueUpdatedByArgumentsObject $argsObject = null)
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

    public function selectUserPermissions(EpicIssueUserPermissionsArgumentsObject $argsObject = null)
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
