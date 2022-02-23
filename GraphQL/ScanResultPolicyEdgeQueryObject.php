<?php

namespace GraphQL\SchemaObject;

class ScanResultPolicyEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "ScanResultPolicyEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(ScanResultPolicyEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new ScanResultPolicyQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
