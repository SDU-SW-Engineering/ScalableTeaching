<?php

namespace GraphQL\SchemaObject;

class UsageTrendsMeasurementEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "UsageTrendsMeasurementEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(UsageTrendsMeasurementEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new UsageTrendsMeasurementQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
