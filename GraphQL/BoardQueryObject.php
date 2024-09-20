<?php

namespace GraphQL\SchemaObject;

class BoardQueryObject extends QueryObject
{
    const OBJECT_NAME = "Board";

    public function selectCreatedAt()
    {
        $this->selectField("createdAt");

        return $this;
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

    public function selectLists(BoardListsArgumentsObject $argsObject = null)
    {
        $object = new BoardListConnectionQueryObject("lists");
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
}
