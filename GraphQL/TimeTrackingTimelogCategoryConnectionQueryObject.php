<?php

namespace GraphQL\SchemaObject;

class TimeTrackingTimelogCategoryConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "TimeTrackingTimelogCategoryConnection";

    public function selectEdges(TimeTrackingTimelogCategoryConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new TimeTrackingTimelogCategoryEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(TimeTrackingTimelogCategoryConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new TimeTrackingTimelogCategoryQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(TimeTrackingTimelogCategoryConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
