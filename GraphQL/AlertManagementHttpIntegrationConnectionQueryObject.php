<?php

namespace GraphQL\SchemaObject;

class AlertManagementHttpIntegrationConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "AlertManagementHttpIntegrationConnection";

    public function selectEdges(AlertManagementHttpIntegrationConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new AlertManagementHttpIntegrationEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(AlertManagementHttpIntegrationConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new AlertManagementHttpIntegrationQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(AlertManagementHttpIntegrationConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
