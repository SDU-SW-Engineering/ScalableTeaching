<?php

namespace GraphQL\SchemaObject;

class DesignAtVersionQueryObject extends QueryObject
{
    const OBJECT_NAME = "DesignAtVersion";

    public function selectDesign(DesignAtVersionDesignArgumentsObject $argsObject = null)
    {
        $object = new DesignQueryObject("design");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectDiffRefs(DesignAtVersionDiffRefsArgumentsObject $argsObject = null)
    {
        $object = new DiffRefsQueryObject("diffRefs");
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

    public function selectIssue(DesignAtVersionIssueArgumentsObject $argsObject = null)
    {
        $object = new IssueQueryObject("issue");
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

    public function selectProject(DesignAtVersionProjectArgumentsObject $argsObject = null)
    {
        $object = new ProjectQueryObject("project");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectVersion(DesignAtVersionVersionArgumentsObject $argsObject = null)
    {
        $object = new DesignVersionQueryObject("version");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
