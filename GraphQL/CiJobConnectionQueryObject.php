<?php

namespace GraphQL\SchemaObject;

class CiJobConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "CiJobConnection";

    public function selectCount()
    {
        $this->selectField("count");

        return $this;
    }

    public function selectEdges(CiJobConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new CiJobEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(CiJobConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new CiJobQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(CiJobConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
