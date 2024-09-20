<?php

namespace GraphQL\SchemaObject;

class ValueStreamEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "ValueStreamEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(ValueStreamEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new ValueStreamQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
