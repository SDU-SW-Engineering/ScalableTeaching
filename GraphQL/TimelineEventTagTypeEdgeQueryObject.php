<?php

namespace GraphQL\SchemaObject;

class TimelineEventTagTypeEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "TimelineEventTagTypeEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(TimelineEventTagTypeEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new TimelineEventTagTypeQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
