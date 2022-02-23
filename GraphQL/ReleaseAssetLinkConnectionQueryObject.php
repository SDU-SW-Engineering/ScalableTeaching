<?php

namespace GraphQL\SchemaObject;

class ReleaseAssetLinkConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "ReleaseAssetLinkConnection";

    public function selectEdges(ReleaseAssetLinkConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new ReleaseAssetLinkEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(ReleaseAssetLinkConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new ReleaseAssetLinkQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(ReleaseAssetLinkConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
