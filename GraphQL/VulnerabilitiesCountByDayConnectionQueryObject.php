<?php

namespace GraphQL\SchemaObject;

class VulnerabilitiesCountByDayConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "VulnerabilitiesCountByDayConnection";

    public function selectEdges(VulnerabilitiesCountByDayConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new VulnerabilitiesCountByDayEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(VulnerabilitiesCountByDayConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new VulnerabilitiesCountByDayQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(VulnerabilitiesCountByDayConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
