<?php

namespace GraphQL\SchemaObject;

class BoardListEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "BoardListEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(BoardListEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new BoardListQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
