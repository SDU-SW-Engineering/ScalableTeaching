<?php

namespace GraphQL\SchemaObject;

class NoteQueryObject extends QueryObject
{
    const OBJECT_NAME = "Note";

    public function selectAuthor(NoteAuthorArgumentsObject $argsObject = null)
    {
        $object = new UserCoreQueryObject("author");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectAuthorIsContributor()
    {
        $this->selectField("authorIsContributor");

        return $this;
    }

    public function selectAwardEmoji(NoteAwardEmojiArgumentsObject $argsObject = null)
    {
        $object = new AwardEmojiConnectionQueryObject("awardEmoji");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectBody()
    {
        $this->selectField("body");

        return $this;
    }

    public function selectBodyHtml()
    {
        $this->selectField("bodyHtml");

        return $this;
    }

    /**
     * @deprecated This was renamed. Please use `internal`. Deprecated in 15.5.
     */
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

    public function selectDiscussion(NoteDiscussionArgumentsObject $argsObject = null)
    {
        $object = new DiscussionQueryObject("discussion");
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

    public function selectInternal()
    {
        $this->selectField("internal");

        return $this;
    }

    public function selectLastEditedAt()
    {
        $this->selectField("lastEditedAt");

        return $this;
    }

    public function selectLastEditedBy(NoteLastEditedByArgumentsObject $argsObject = null)
    {
        $object = new UserCoreQueryObject("lastEditedBy");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectMaxAccessLevelOfAuthor()
    {
        $this->selectField("maxAccessLevelOfAuthor");

        return $this;
    }

    public function selectPosition(NotePositionArgumentsObject $argsObject = null)
    {
        $object = new DiffPositionQueryObject("position");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectProject(NoteProjectArgumentsObject $argsObject = null)
    {
        $object = new ProjectQueryObject("project");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
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

    public function selectResolvedBy(NoteResolvedByArgumentsObject $argsObject = null)
    {
        $object = new UserCoreQueryObject("resolvedBy");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSystem()
    {
        $this->selectField("system");

        return $this;
    }

    public function selectSystemNoteIconName()
    {
        $this->selectField("systemNoteIconName");

        return $this;
    }

    public function selectSystemNoteMetadata(NoteSystemNoteMetadataArgumentsObject $argsObject = null)
    {
        $object = new SystemNoteMetadataQueryObject("systemNoteMetadata");
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

    public function selectUrl()
    {
        $this->selectField("url");

        return $this;
    }

    public function selectUserPermissions(NoteUserPermissionsArgumentsObject $argsObject = null)
    {
        $object = new NotePermissionsQueryObject("userPermissions");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
