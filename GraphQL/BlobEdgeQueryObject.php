<?php

namespace GraphQL\SchemaObject;

class BlobEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "BlobEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(BlobEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new BlobQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
