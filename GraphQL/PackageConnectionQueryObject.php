<?php

namespace GraphQL\SchemaObject;

class PackageConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "PackageConnection";

    public function selectCount()
    {
        $this->selectField("count");

        return $this;
    }

    public function selectEdges(PackageConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new PackageEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(PackageConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new PackageQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(PackageConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
