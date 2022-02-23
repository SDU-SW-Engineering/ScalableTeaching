<?php

namespace GraphQL\SchemaObject;

class IncidentManagementOncallScheduleEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "IncidentManagementOncallScheduleEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(IncidentManagementOncallScheduleEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new IncidentManagementOncallScheduleQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
