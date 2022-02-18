<?php

namespace GraphQL\SchemaObject;

class UsageTrendsMeasurementConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "UsageTrendsMeasurementConnection";

    public function selectEdges(UsageTrendsMeasurementConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new UsageTrendsMeasurementEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(UsageTrendsMeasurementConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new UsageTrendsMeasurementQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(UsageTrendsMeasurementConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
