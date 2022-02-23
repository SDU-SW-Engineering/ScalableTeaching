<?php

namespace GraphQL\SchemaObject;

class CiConfigStageConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "CiConfigStageConnection";

    public function selectEdges(CiConfigStageConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new CiConfigStageEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(CiConfigStageConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new CiConfigStageQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(CiConfigStageConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
