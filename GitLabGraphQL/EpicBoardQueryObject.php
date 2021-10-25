<?php

namespace GraphQL\SchemaObject;

class EpicBoardQueryObject extends QueryObject
{
    const OBJECT_NAME = "EpicBoard";

    public function selectHideBacklogList()
    {
        $this->selectField("hideBacklogList");

        return $this;
    }

    public function selectHideClosedList()
    {
        $this->selectField("hideClosedList");

        return $this;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectLabels(EpicBoardLabelsArgumentsObject $argsObject = null)
    {
        $object = new LabelConnectionQueryObject("labels");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectLists(EpicBoardListsArgumentsObject $argsObject = null)
    {
        $object = new EpicListConnectionQueryObject("lists");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectName()
    {
        $this->selectField("name");

        return $this;
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
