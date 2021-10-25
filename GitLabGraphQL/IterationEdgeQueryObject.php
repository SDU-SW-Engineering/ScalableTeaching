<?php

namespace GraphQL\SchemaObject;

class IterationEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "IterationEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(IterationEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new IterationQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
