<?php

namespace GraphQL\SchemaObject;

class CiGroupConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "CiGroupConnection";

    public function selectEdges(CiGroupConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new CiGroupEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(CiGroupConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new CiGroupQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(CiGroupConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
