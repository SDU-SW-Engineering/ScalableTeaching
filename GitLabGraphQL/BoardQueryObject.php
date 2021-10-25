<?php

namespace GraphQL\SchemaObject;

class BoardQueryObject extends QueryObject
{
    const OBJECT_NAME = "Board";

    public function selectAssignee(BoardAssigneeArgumentsObject $argsObject = null)
    {
        $object = new UserCoreQueryObject("assignee");
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

    public function selectEpics(BoardEpicsArgumentsObject $argsObject = null)
    {
        $object = new BoardEpicConnectionQueryObject("epics");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

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

    public function selectIteration(BoardIterationArgumentsObject $argsObject = null)
    {
        $object = new IterationQueryObject("iteration");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectIterationCadence(BoardIterationCadenceArgumentsObject $argsObject = null)
    {
        $object = new IterationCadenceQueryObject("iterationCadence");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectLabels(BoardLabelsArgumentsObject $argsObject = null)
    {
        $object = new LabelConnectionQueryObject("labels");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectLists(BoardListsArgumentsObject $argsObject = null)
    {
        $object = new BoardListConnectionQueryObject("lists");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectMilestone(BoardMilestoneArgumentsObject $argsObject = null)
    {
        $object = new MilestoneQueryObject("milestone");
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

    public function selectUpdatedAt()
    {
        $this->selectField("updatedAt");

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

    public function selectWeight()
    {
        $this->selectField("weight");

        return $this;
    }
}
