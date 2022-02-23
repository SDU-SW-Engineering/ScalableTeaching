<?php

namespace GraphQL\SchemaObject;

class TimelogEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "TimelogEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(TimelogEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new TimelogQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
