<?php

namespace GraphQL\SchemaObject;

class DependencyProxyBlobEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "DependencyProxyBlobEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(DependencyProxyBlobEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new DependencyProxyBlobQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
