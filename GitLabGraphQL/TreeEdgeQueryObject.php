<?php

namespace GraphQL\SchemaObject;

class TreeEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "TreeEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(TreeEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new TreeQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
