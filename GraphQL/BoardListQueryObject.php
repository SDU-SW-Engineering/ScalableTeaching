<?php

namespace GraphQL\SchemaObject;

class BoardListQueryObject extends QueryObject
{
    const OBJECT_NAME = "BoardList";

    public function selectCollapsed()
    {
        $this->selectField("collapsed");

        return $this;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectIssues(BoardListIssuesArgumentsObject $argsObject = null)
    {
        $object = new IssueConnectionQueryObject("issues");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectIssuesCount()
    {
        $this->selectField("issuesCount");

        return $this;
    }

    public function selectLabel(BoardListLabelArgumentsObject $argsObject = null)
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
