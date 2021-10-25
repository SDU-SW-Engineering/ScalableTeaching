<?php

namespace GraphQL\SchemaObject;

class AlertManagementIntegrationConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "AlertManagementIntegrationConnection";

    public function selectEdges(AlertManagementIntegrationConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new AlertManagementIntegrationEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(AlertManagementIntegrationConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
