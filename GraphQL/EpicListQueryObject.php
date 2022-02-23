<?php

namespace GraphQL\SchemaObject;

class EpicListQueryObject extends QueryObject
{
    const OBJECT_NAME = "EpicList";

    public function selectCollapsed()
    {
        $this->selectField("collapsed");

        return $this;
    }

    public function selectEpics(EpicListEpicsArgumentsObject $argsObject = null)
    {
        $object = new EpicConnectionQueryObject("epics");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectEpicsCount()
    {
        $this->selectField("epicsCount");

        return $this;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectLabel(EpicListLabelArgumentsObject $argsObject = null)
    {
        $object = new LabelQueryObject("label");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectListType()
    {
        $this->selectField("listType");

        return $this;
    }

    public function selectPosition()
    {
        $this->selectField("position");

        return $this;
    }

    public function selectTitle()
    {
        $this->selectField("title");

        return $this;
    }
}
