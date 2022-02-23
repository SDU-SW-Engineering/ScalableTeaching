<?php

namespace GraphQL\SchemaObject;

class CiConfigJobEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "CiConfigJobEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(CiConfigJobEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new CiConfigJobQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
