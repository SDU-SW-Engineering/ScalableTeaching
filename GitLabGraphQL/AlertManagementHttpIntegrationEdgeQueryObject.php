<?php

namespace GraphQL\SchemaObject;

class AlertManagementHttpIntegrationEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "AlertManagementHttpIntegrationEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(AlertManagementHttpIntegrationEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new AlertManagementHttpIntegrationQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
