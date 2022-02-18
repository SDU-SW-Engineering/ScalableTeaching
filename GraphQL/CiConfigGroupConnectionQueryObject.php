<?php

namespace GraphQL\SchemaObject;

class CiConfigGroupConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "CiConfigGroupConnection";

    public function selectEdges(CiConfigGroupConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new CiConfigGroupEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(CiConfigGroupConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new CiConfigGroupQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(CiConfigGroupConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
