<?php

namespace GraphQL\SchemaObject;

class DesignCollectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "DesignCollection";

    public function selectCopyState()
    {
        $this->selectField("copyState");

        return $this;
    }

    public function selectDesign(DesignCollectionDesignArgumentsObject $argsObject = null)
    {
        $object = new DesignQueryObject("design");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectDesignAtVersion(DesignCollectionDesignAtVersionArgumentsObject $argsObject = null)
    {
        $object = new DesignAtVersionQueryObject("designAtVersion");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectDesigns(DesignCollectionDesignsArgumentsObject $argsObject = null)
    {
        $object = new DesignConnectionQueryObject("designs");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectIssue(DesignCollectionIssueArgumentsObject $argsObject = null)
    {
        $object = new IssueQueryObject("issue");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectProject(DesignCollectionProjectArgumentsObject $argsObject = null)
    {
        $object = new ProjectQueryObject("project");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectVersion(DesignCollectionVersionArgumentsObject $argsObject = null)
    {
        $object = new DesignVersionQueryObject("version");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectVersions(DesignCollectionVersionsArgumentsObject $argsObject = null)
    {
        $object = new DesignVersionConnectionQueryObject("versions");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
