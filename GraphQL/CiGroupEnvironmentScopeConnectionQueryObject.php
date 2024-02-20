<?php

namespace GraphQL\SchemaObject;

class CiGroupEnvironmentScopeConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "CiGroupEnvironmentScopeConnection";

    public function selectEdges(CiGroupEnvironmentScopeConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new CiGroupEnvironmentScopeEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(CiGroupEnvironmentScopeConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new CiGroupEnvironmentScopeQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(CiGroupEnvironmentScopeConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
