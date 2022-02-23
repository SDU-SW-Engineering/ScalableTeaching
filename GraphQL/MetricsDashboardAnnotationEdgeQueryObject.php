<?php

namespace GraphQL\SchemaObject;

class MetricsDashboardAnnotationEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "MetricsDashboardAnnotationEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(MetricsDashboardAnnotationEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new MetricsDashboardAnnotationQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
