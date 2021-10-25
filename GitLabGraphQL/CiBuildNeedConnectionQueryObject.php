<?php

namespace GraphQL\SchemaObject;

class CiBuildNeedConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "CiBuildNeedConnection";

    public function selectEdges(CiBuildNeedConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new CiBuildNeedEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(CiBuildNeedConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new CiBuildNeedQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(CiBuildNeedConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
