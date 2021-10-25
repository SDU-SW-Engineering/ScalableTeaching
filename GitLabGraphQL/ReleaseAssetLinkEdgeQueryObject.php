<?php

namespace GraphQL\SchemaObject;

class ReleaseAssetLinkEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "ReleaseAssetLinkEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(ReleaseAssetLinkEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new ReleaseAssetLinkQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
