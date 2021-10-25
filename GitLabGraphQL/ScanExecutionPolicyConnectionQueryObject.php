<?php

namespace GraphQL\SchemaObject;

class ScanExecutionPolicyConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "ScanExecutionPolicyConnection";

    public function selectEdges(ScanExecutionPolicyConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new ScanExecutionPolicyEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(ScanExecutionPolicyConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new ScanExecutionPolicyQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(ScanExecutionPolicyConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
