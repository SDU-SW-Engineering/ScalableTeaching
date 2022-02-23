<?php

namespace GraphQL\SchemaObject;

class IterationCadenceEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "IterationCadenceEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(IterationCadenceEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new IterationCadenceQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
