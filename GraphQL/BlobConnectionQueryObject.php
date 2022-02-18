<?php

namespace GraphQL\SchemaObject;

class BlobConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "BlobConnection";

    public function selectEdges(BlobConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new BlobEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(BlobConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new BlobQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(BlobConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
