<?php

namespace GraphQL\SchemaObject;

class PackageBaseEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "PackageBaseEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(PackageBaseEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new PackageBaseQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
