<?php

namespace GraphQL\SchemaObject;

class ScanExecutionPolicyEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "ScanExecutionPolicyEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(ScanExecutionPolicyEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new ScanExecutionPolicyQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
