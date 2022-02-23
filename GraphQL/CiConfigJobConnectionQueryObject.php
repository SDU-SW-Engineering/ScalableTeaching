<?php

namespace GraphQL\SchemaObject;

class CiConfigJobConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "CiConfigJobConnection";

    public function selectEdges(CiConfigJobConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new CiConfigJobEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(CiConfigJobConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new CiConfigJobQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(CiConfigJobConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
