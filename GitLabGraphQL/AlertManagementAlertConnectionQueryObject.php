<?php

namespace GraphQL\SchemaObject;

class AlertManagementAlertConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "AlertManagementAlertConnection";

    public function selectEdges(AlertManagementAlertConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new AlertManagementAlertEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(AlertManagementAlertConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new AlertManagementAlertQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(AlertManagementAlertConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
