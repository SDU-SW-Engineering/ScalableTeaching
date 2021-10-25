<?php

namespace GraphQL\SchemaObject;

class MetricsDashboardAnnotationConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "MetricsDashboardAnnotationConnection";

    public function selectEdges(MetricsDashboardAnnotationConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new MetricsDashboardAnnotationEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(MetricsDashboardAnnotationConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new MetricsDashboardAnnotationQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(MetricsDashboardAnnotationConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
