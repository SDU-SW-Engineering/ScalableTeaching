<?php

namespace GraphQL\SchemaObject;

class BoardEpicQueryObject extends QueryObject
{
    const OBJECT_NAME = "BoardEpic";

    public function selectAncestors(BoardEpicAncestorsArgumentsObject $argsObject = null)
    {
        $object = new EpicConnectionQueryObject("ancestors");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectAuthor(BoardEpicAuthorArgumentsObject $argsObject = null)
    {
        $object = new UserCoreQueryObject("author");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectAwardEmoji(BoardEpicAwardEmojiArgumentsObject $argsObject = null)
    {
        $object = new AwardEmojiConnectionQueryObject("awardEmoji");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectChildren(BoardEpicChildrenArgumentsObject $argsObject = null)
    {
        $object = new EpicConnectionQueryObject("children");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
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

    public function selectCreatedAt()
    {
        $this->selectField("createdAt");

        return $this;
    }

    public function selectCurrentUserTodos(BoardEpicCurrentUserTodosArgumentsObject $argsObject = null)
    {
        $object = new TodoConnectionQueryObject("currentUserTodos");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectDescendantCounts(BoardEpicDescendantCountsArgumentsObject $argsObject = null)
    {
        $object = new EpicDescendantCountQueryObject("descendantCounts");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectDescendantWeightSum(BoardEpicDescendantWeightSumArgumentsObject $argsObject = null)
    {
        $object = new EpicDescendantWeightsQueryObject("descendantWeightSum");
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

    public function selectDiscussions(BoardEpicDiscussionsArgumentsObject $argsObject = null)
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

    public function selectDueDateFixed()
    {
        $this->selectField("dueDateFixed");

        return $this;
    }

    public function selectDueDateFromInheritedSource()
    {
        $this->selectField("dueDateFromInheritedSource");

        return $this;
    }

    public function selectDueDateFromMilestones()
    {
        $this->selectField("dueDateFromMilestones");

        return $this;
    }

    public function selectDueDateIsFixed()
    {
        $this->selectField("dueDateIsFixed");

        return $this;
    }

    public function selectEvents(BoardEpicEventsArgumentsObject $argsObject = null)
    {
        $object = new EventConnectionQueryObject("events");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectGroup(BoardEpicGroupArgumentsObject $argsObject = null)
    {
        $object = new GroupQueryObject("group");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectHasChildren()
    {
        $this->selectField("hasChildren");

        return $this;
    }

    public function selectHasIssues()
    {
        $this->selectField("hasIssues");

        return $this;
    }

    public function selectHasParent()
    {
        $this->selectField("hasParent");

        return $this;
    }

    public function selectHealthStatus(BoardEpicHealthStatusArgumentsObject $argsObject = null)
    {
        $object = new EpicHealthStatusQueryObject("healthStatus");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
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

    public function selectIssues(BoardEpicIssuesArgumentsObject $argsObject = null)
    {
        $object = new EpicIssueConnectionQueryObject("issues");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectLabels(BoardEpicLabelsArgumentsObject $argsObject = null)
    {
        $object = new LabelConnectionQueryObject("labels");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNotes(BoardEpicNotesArgumentsObject $argsObject = null)
    {
        $object = new NoteConnectionQueryObject("notes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectParent(BoardEpicParentArgumentsObject $argsObject = null)
    {
        $object = new EpicQueryObject("parent");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectParticipants(BoardEpicParticipantsArgumentsObject $argsObject = null)
    {
        $object = new UserCoreConnectionQueryObject("participants");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
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

    public function selectStartDate()
    {
        $this->selectField("startDate");

        return $this;
    }

    public function selectStartDateFixed()
    {
        $this->selectField("startDateFixed");

        return $this;
    }

    public function selectStartDateFromInheritedSource()
    {
        $this->selectField("startDateFromInheritedSource");

        return $this;
    }

    public function selectStartDateFromMilestones()
    {
        $this->selectField("startDateFromMilestones");

        return $this;
    }

    public function selectStartDateIsFixed()
    {
        $this->selectField("startDateIsFixed");

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

    public function selectUserPermissions(BoardEpicUserPermissionsArgumentsObject $argsObject = null)
    {
        $object = new EpicPermissionsQueryObject("userPermissions");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectUserPreferences(BoardEpicUserPreferencesArgumentsObject $argsObject = null)
    {
        $object = new BoardEpicUserPreferencesQueryObject("userPreferences");
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
}
