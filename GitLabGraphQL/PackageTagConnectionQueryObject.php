<?php

namespace GraphQL\SchemaObject;

class PackageTagConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "PackageTagConnection";

    public function selectEdges(PackageTagConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new PackageTagEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(PackageTagConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new PackageTagQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(PackageTagConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
