<?php

namespace GraphQL\SchemaObject;

class BoardConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "BoardConnection";

    public function selectEdges(BoardConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new BoardEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(BoardConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new BoardQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(BoardConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
