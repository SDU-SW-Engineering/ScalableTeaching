<?php

namespace GraphQL\SchemaObject;

class PushAccessLevelEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "PushAccessLevelEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(PushAccessLevelEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new PushAccessLevelQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
