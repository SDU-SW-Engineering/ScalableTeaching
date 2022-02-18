<?php

namespace GraphQL\SchemaObject;

class EventEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "EventEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(EventEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new EventQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
