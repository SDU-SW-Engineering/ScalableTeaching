<?php

namespace GraphQL\SchemaObject;

class BoardListConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "BoardListConnection";

    public function selectEdges(BoardListConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new BoardListEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(BoardListConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new BoardListQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(BoardListConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
