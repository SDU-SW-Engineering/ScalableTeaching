<?php

namespace GraphQL\SchemaObject;

class GroupEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "GroupEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(GroupEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new GroupQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
