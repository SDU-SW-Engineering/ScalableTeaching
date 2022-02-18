<?php

namespace GraphQL\SchemaObject;

class EpicBoardConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "EpicBoardConnection";

    public function selectEdges(EpicBoardConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new EpicBoardEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(EpicBoardConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new EpicBoardQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(EpicBoardConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
