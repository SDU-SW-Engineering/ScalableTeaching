<?php

namespace GraphQL\SchemaObject;

class CiGroupVariableConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "CiGroupVariableConnection";

    public function selectEdges(CiGroupVariableConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new CiGroupVariableEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectLimit()
    {
        $this->selectField("limit");

        return $this;
    }

    public function selectNodes(CiGroupVariableConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new CiGroupVariableQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(CiGroupVariableConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
