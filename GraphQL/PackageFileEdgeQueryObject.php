<?php

namespace GraphQL\SchemaObject;

class PackageFileEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "PackageFileEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(PackageFileEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new PackageFileQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
