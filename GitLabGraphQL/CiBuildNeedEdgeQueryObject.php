<?php

namespace GraphQL\SchemaObject;

class CiBuildNeedEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "CiBuildNeedEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(CiBuildNeedEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new CiBuildNeedQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
