<?php

namespace GraphQL\SchemaObject;

class EnvironmentEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "EnvironmentEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(EnvironmentEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new EnvironmentQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
