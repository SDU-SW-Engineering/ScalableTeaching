<?php

namespace GraphQL\SchemaObject;

class CiMinutesNamespaceMonthlyUsageEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "CiMinutesNamespaceMonthlyUsageEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(CiMinutesNamespaceMonthlyUsageEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new CiMinutesNamespaceMonthlyUsageQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
