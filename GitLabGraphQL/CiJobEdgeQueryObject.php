<?php

namespace GraphQL\SchemaObject;

class CiJobEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "CiJobEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(CiJobEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new CiJobQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
