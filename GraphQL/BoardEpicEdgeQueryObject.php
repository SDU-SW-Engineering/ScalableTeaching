<?php

namespace GraphQL\SchemaObject;

class BoardEpicEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "BoardEpicEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(BoardEpicEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new BoardEpicQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
