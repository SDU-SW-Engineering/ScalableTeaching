<?php

namespace GraphQL\SchemaObject;

class RepositoryBlobConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "RepositoryBlobConnection";

    public function selectEdges(RepositoryBlobConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new RepositoryBlobEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(RepositoryBlobConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new RepositoryBlobQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(RepositoryBlobConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
