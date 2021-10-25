<?php

namespace GraphQL\SchemaObject;

class BoardEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "BoardEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(BoardEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new BoardQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
