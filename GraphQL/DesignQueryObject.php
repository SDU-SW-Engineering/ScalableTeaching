<?php

namespace GraphQL\SchemaObject;

class DesignQueryObject extends QueryObject
{
    const OBJECT_NAME = "Design";

    public function selectCommenters(DesignCommentersArgumentsObject $argsObject = null)
    {
        $object = new UserCoreConnectionQueryObject("commenters");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCurrentUserTodos(DesignCurrentUserTodosArgumentsObject $argsObject = null)
    {
        $object = new TodoConnectionQueryObject("currentUserTodos");
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

    public function selectDiffRefs(DesignDiffRefsArgumentsObject $argsObject = null)
    {
        $object = new DiffRefsQueryObject("diffRefs");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectDiscussions(DesignDiscussionsArgumentsObject $argsObject = null)
    {
        $object = new DiscussionConnectionQueryObject("discussions");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectEvent()
    {
        $this->selectField("event");

        return $this;
    }

    public function selectFilename()
    {
        $this->selectField("filename");

        return $this;
    }

    public function selectFullPath()
    {
        $this->selectField("fullPath");

        return $this;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectImage()
    {
        $this->selectField("image");

        return $this;
    }

    public function selectImageV432x230()
    {
        $this->selectField("imageV432x230");

        return $this;
    }

    public function selectIssue(DesignIssueArgumentsObject $argsObject = null)
    {
        $object = new IssueQueryObject("issue");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNotes(DesignNotesArgumentsObject $argsObject = null)
    {
        $object = new NoteConnectionQueryObject("notes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNotesCount()
    {
        $this->selectField("notesCount");

        return $this;
    }

    public function selectProject(DesignProjectArgumentsObject $argsObject = null)
    {
        $object = new ProjectQueryObject("project");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectVersions(DesignVersionsArgumentsObject $argsObject = null)
    {
        $object = new DesignVersionConnectionQueryObject("versions");
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
}
