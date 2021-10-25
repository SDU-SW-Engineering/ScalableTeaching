<?php

namespace GraphQL\SchemaObject;

class PackageTagEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "PackageTagEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(PackageTagEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new PackageTagQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
