<?php

namespace GraphQL\SchemaObject;

class PackageFileRegistryConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "PackageFileRegistryConnection";

    public function selectEdges(PackageFileRegistryConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new PackageFileRegistryEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(PackageFileRegistryConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new PackageFileRegistryQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(PackageFileRegistryConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
