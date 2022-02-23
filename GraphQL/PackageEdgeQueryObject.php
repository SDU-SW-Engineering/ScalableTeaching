<?php

namespace GraphQL\SchemaObject;

class PackageEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "PackageEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(PackageEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new PackageQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
