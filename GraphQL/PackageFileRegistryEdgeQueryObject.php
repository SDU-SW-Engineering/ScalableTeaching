<?php

namespace GraphQL\SchemaObject;

class PackageFileRegistryEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "PackageFileRegistryEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(PackageFileRegistryEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new PackageFileRegistryQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
