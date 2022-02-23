<?php

namespace GraphQL\SchemaObject;

class CiMinutesProjectMonthlyUsageConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "CiMinutesProjectMonthlyUsageConnection";

    public function selectEdges(CiMinutesProjectMonthlyUsageConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new CiMinutesProjectMonthlyUsageEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(CiMinutesProjectMonthlyUsageConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new CiMinutesProjectMonthlyUsageQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(CiMinutesProjectMonthlyUsageConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
