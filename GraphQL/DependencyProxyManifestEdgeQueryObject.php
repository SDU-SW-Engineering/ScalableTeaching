<?php

namespace GraphQL\SchemaObject;

class DependencyProxyManifestEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "DependencyProxyManifestEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(DependencyProxyManifestEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new DependencyProxyManifestQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
