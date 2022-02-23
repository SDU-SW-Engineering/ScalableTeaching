<?php

namespace GraphQL\SchemaObject;

class TimelineEventTypeConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "TimelineEventTypeConnection";

    public function selectEdges(TimelineEventTypeConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new TimelineEventTypeEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(TimelineEventTypeConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new TimelineEventTypeQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(TimelineEventTypeConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
