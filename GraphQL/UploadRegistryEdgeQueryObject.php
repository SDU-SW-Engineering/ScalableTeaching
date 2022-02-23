<?php

namespace GraphQL\SchemaObject;

class UploadRegistryEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "UploadRegistryEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(UploadRegistryEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new UploadRegistryQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
