<?php

namespace GraphQL\SchemaObject;

class CiMinutesProjectMonthlyUsageEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "CiMinutesProjectMonthlyUsageEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(CiMinutesProjectMonthlyUsageEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new CiMinutesProjectMonthlyUsageQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
