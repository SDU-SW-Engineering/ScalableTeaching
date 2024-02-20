<?php

namespace GraphQL\SchemaObject;

class NestedEnvironmentEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "NestedEnvironmentEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(NestedEnvironmentEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new NestedEnvironmentQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
