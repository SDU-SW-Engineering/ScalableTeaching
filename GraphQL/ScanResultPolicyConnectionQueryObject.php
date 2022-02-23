<?php

namespace GraphQL\SchemaObject;

class ScanResultPolicyConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "ScanResultPolicyConnection";

    public function selectEdges(ScanResultPolicyConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new ScanResultPolicyEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(ScanResultPolicyConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new ScanResultPolicyQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(ScanResultPolicyConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
