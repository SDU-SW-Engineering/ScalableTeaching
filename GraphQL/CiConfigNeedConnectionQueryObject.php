<?php

namespace GraphQL\SchemaObject;

class CiConfigNeedConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "CiConfigNeedConnection";

    public function selectEdges(CiConfigNeedConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new CiConfigNeedEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(CiConfigNeedConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new CiConfigNeedQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(CiConfigNeedConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
