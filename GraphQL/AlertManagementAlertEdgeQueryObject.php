<?php

namespace GraphQL\SchemaObject;

class AlertManagementAlertEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "AlertManagementAlertEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(AlertManagementAlertEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new AlertManagementAlertQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
