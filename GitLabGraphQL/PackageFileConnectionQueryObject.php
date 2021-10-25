<?php

namespace GraphQL\SchemaObject;

class PackageFileConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "PackageFileConnection";

    public function selectEdges(PackageFileConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new PackageFileEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(PackageFileConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new PackageFileQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(PackageFileConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
