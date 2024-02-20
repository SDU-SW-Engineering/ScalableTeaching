<?php

namespace GraphQL\SchemaObject;

class EgressNodeEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "EgressNodeEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(EgressNodeEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new EgressNodeQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
