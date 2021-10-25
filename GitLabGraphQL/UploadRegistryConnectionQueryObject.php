<?php

namespace GraphQL\SchemaObject;

class UploadRegistryConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "UploadRegistryConnection";

    public function selectEdges(UploadRegistryConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new UploadRegistryEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(UploadRegistryConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new UploadRegistryQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(UploadRegistryConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
