<?php

namespace GraphQL\SchemaObject;

class TimelineEventTypeEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "TimelineEventTypeEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(TimelineEventTypeEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new TimelineEventTypeQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
