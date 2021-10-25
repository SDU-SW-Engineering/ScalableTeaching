<?php

namespace GraphQL\SchemaObject;

class IncidentManagementOncallShiftEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "IncidentManagementOncallShiftEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(IncidentManagementOncallShiftEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new IncidentManagementOncallShiftQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
