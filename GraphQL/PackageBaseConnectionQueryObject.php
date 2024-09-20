<?php

namespace GraphQL\SchemaObject;

class PackageBaseConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "PackageBaseConnection";

    public function selectCount()
    {
        $this->selectField("count");

        return $this;
    }

    public function selectEdges(PackageBaseConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new PackageBaseEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(PackageBaseConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new PackageBaseQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(PackageBaseConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
