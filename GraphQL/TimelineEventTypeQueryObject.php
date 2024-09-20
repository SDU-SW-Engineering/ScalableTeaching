<?php

namespace GraphQL\SchemaObject;

class TimelineEventTypeQueryObject extends QueryObject
{
    const OBJECT_NAME = "TimelineEventType";

    public function selectAction()
    {
        $this->selectField("action");

        return $this;
    }

    public function selectAuthor(TimelineEventTypeAuthorArgumentsObject $argsObject = null)
    {
        $object = new UserCoreQueryObject("author");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCreatedAt()
    {
        $this->selectField("createdAt");

        return $this;
    }

    public function selectEditable()
    {
        $this->selectField("editable");

        return $this;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectIncident(TimelineEventTypeIncidentArgumentsObject $argsObject = null)
    {
        $object = new IssueQueryObject("incident");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNote()
    {
        $this->selectField("note");

        return $this;
    }

    public function selectNoteHtml()
    {
        $this->selectField("noteHtml");

        return $this;
    }

    public function selectOccurredAt()
    {
        $this->selectField("occurredAt");

        return $this;
    }

    public function selectPromotedFromNote(TimelineEventTypePromotedFromNoteArgumentsObject $argsObject = null)
    {
        $object = new NoteQueryObject("promotedFromNote");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTimelineEventTags(TimelineEventTypeTimelineEventTagsArgumentsObject $argsObject = null)
    {
        $object = new TimelineEventTagTypeConnectionQueryObject("timelineEventTags");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectUpdatedAt()
    {
        $this->selectField("updatedAt");

        return $this;
    }

    public function selectUpdatedByUser(TimelineEventTypeUpdatedByUserArgumentsObject $argsObject = null)
    {
        $object = new UserCoreQueryObject("updatedByUser");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
