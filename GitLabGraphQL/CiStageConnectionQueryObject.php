<?php

namespace GraphQL\SchemaObject;

class CiStageConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "CiStageConnection";

    public function selectEdges(CiStageConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new CiStageEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(CiStageConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new CiStageQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(CiStageConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
