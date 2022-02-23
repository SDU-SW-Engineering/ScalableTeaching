<?php

namespace GraphQL\SchemaObject;

class VulnerabilitiesCountByDayEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "VulnerabilitiesCountByDayEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(VulnerabilitiesCountByDayEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new VulnerabilitiesCountByDayQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
