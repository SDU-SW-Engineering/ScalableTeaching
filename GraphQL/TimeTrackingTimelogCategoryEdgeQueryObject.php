<?php

namespace GraphQL\SchemaObject;

class TimeTrackingTimelogCategoryEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "TimeTrackingTimelogCategoryEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(TimeTrackingTimelogCategoryEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new TimeTrackingTimelogCategoryQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
