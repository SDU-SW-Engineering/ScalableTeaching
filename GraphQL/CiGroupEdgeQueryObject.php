<?php

namespace GraphQL\SchemaObject;

class CiGroupEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "CiGroupEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(CiGroupEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new CiGroupQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
