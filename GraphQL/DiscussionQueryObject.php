<?php

namespace GraphQL\SchemaObject;

class DiscussionQueryObject extends QueryObject
{
    const OBJECT_NAME = "Discussion";

    public function selectCreatedAt()
    {
        $this->selectField("createdAt");

        return $this;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectNoteable(DiscussionNoteableArgumentsObject $argsObject = null)
    {
        $object = new NoteableTypeUnionObject("noteable");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNotes(DiscussionNotesArgumentsObject $argsObject = null)
    {
        $object = new NoteConnectionQueryObject("notes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectReplyId()
    {
        $this->selectField("replyId");

        return $this;
    }

    public function selectResolvable()
    {
        $this->selectField("resolvable");

        return $this;
    }

    public function selectResolved()
    {
        $this->selectField("resolved");

        return $this;
    }

    public function selectResolvedAt()
    {
        $this->selectField("resolvedAt");

        return $this;
    }

    public function selectResolvedBy(DiscussionResolvedByArgumentsObject $argsObject = null)
    {
        $object = new UserCoreQueryObject("resolvedBy");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
