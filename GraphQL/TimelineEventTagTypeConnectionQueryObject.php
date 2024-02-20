<?php

namespace GraphQL\SchemaObject;

class TimelineEventTagTypeConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "TimelineEventTagTypeConnection";

    public function selectEdges(TimelineEventTagTypeConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new TimelineEventTagTypeEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(TimelineEventTagTypeConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new TimelineEventTagTypeQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(TimelineEventTagTypeConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
