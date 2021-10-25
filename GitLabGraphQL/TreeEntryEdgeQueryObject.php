<?php

namespace GraphQL\SchemaObject;

class TreeEntryEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "TreeEntryEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(TreeEntryEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new TreeEntryQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
