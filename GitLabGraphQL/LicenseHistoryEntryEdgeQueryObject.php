<?php

namespace GraphQL\SchemaObject;

class LicenseHistoryEntryEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "LicenseHistoryEntryEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(LicenseHistoryEntryEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new LicenseHistoryEntryQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
