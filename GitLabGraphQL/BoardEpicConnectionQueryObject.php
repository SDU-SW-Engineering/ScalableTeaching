<?php

namespace GraphQL\SchemaObject;

class BoardEpicConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "BoardEpicConnection";

    public function selectEdges(BoardEpicConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new BoardEpicEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(BoardEpicConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new BoardEpicQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(BoardEpicConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
