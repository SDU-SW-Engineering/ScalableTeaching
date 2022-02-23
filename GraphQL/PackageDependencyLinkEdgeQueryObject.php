<?php

namespace GraphQL\SchemaObject;

class PackageDependencyLinkEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "PackageDependencyLinkEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(PackageDependencyLinkEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new PackageDependencyLinkQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
