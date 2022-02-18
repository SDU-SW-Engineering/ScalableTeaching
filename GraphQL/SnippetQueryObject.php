<?php

namespace GraphQL\SchemaObject;

class SnippetQueryObject extends QueryObject
{
    const OBJECT_NAME = "Snippet";

    public function selectAuthor(SnippetAuthorArgumentsObject $argsObject = null)
    {
        $object = new UserCoreQueryObject("author");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectBlobs(SnippetBlobsArgumentsObject $argsObject = null)
    {
        $object = new SnippetBlobConnectionQueryObject("blobs");
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

    public function selectDiscussions(SnippetDiscussionsArgumentsObject $argsObject = null)
    {
        $object = new DiscussionConnectionQueryObject("discussions");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectFileName()
    {
        $this->selectField("fileName");

        return $this;
    }

    public function selectHttpUrlToRepo()
    {
        $this->selectField("httpUrlToRepo");

        return $this;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectNotes(SnippetNotesArgumentsObject $argsObject = null)
    {
        $object = new NoteConnectionQueryObject("notes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectProject(SnippetProjectArgumentsObject $argsObject = null)
    {
        $object = new ProjectQueryObject("project");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRawUrl()
    {
        $this->selectField("rawUrl");

        return $this;
    }

    public function selectSshUrlToRepo()
    {
        $this->selectField("sshUrlToRepo");

        return $this;
    }

    public function selectTitle()
    {
        $this->selectField("title");

        return $this;
    }

    public function selectUpdatedAt()
    {
        $this->selectField("updatedAt");

        return $this;
    }

    public function selectUserPermissions(SnippetUserPermissionsArgumentsObject $argsObject = null)
    {
        $object = new SnippetPermissionsQueryObject("userPermissions");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectVisibilityLevel()
    {
        $this->selectField("visibilityLevel");

        return $this;
    }

    public function selectWebUrl()
    {
        $this->selectField("webUrl");

        return $this;
    }
}
