<?php

namespace GraphQL\SchemaObject;

class CiConfigNeedEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "CiConfigNeedEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(CiConfigNeedEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new CiConfigNeedQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
