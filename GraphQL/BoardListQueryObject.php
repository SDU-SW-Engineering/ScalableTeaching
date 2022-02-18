<?php

namespace GraphQL\SchemaObject;

class BoardListQueryObject extends QueryObject
{
    const OBJECT_NAME = "BoardList";

    public function selectAssignee(BoardListAssigneeArgumentsObject $argsObject = null)
    {
        $object = new UserCoreQueryObject("assignee");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

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

    public function selectIteration(BoardListIterationArgumentsObject $argsObject = null)
    {
        $object = new IterationQueryObject("iteration");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
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

    public function selectLimitMetric()
    {
        $this->selectField("limitMetric");

        return $this;
    }

    public function selectListType()
    {
        $this->selectField("listType");

        return $this;
    }

    public function selectMaxIssueCount()
    {
        $this->selectField("maxIssueCount");

        return $this;
    }

    public function selectMaxIssueWeight()
    {
        $this->selectField("maxIssueWeight");

        return $this;
    }

    public function selectMilestone(BoardListMilestoneArgumentsObject $argsObject = null)
    {
        $object = new MilestoneQueryObject("milestone");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
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

    public function selectTotalWeight()
    {
        $this->selectField("totalWeight");

        return $this;
    }
}
