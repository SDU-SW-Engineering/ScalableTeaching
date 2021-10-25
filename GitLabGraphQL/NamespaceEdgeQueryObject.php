<?php

namespace GraphQL\SchemaObject;

class NamespaceEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "NamespaceEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(NamespaceEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new NamespaceQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
