<?php

namespace GraphQL\SchemaObject;

class CiMinutesNamespaceMonthlyUsageConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "CiMinutesNamespaceMonthlyUsageConnection";

    public function selectEdges(CiMinutesNamespaceMonthlyUsageConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new CiMinutesNamespaceMonthlyUsageEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(CiMinutesNamespaceMonthlyUsageConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new CiMinutesNamespaceMonthlyUsageQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(CiMinutesNamespaceMonthlyUsageConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
