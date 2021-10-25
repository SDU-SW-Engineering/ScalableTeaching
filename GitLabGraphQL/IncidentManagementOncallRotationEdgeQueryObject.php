<?php

namespace GraphQL\SchemaObject;

class IncidentManagementOncallRotationEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "IncidentManagementOncallRotationEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(IncidentManagementOncallRotationEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new IncidentManagementOncallRotationQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
