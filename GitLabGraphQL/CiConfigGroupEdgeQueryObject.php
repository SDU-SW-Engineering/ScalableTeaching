<?php

namespace GraphQL\SchemaObject;

class CiConfigGroupEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "CiConfigGroupEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(CiConfigGroupEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new CiConfigGroupQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
