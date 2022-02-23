<?php

namespace GraphQL\SchemaObject;

class DependencyProxyBlobConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "DependencyProxyBlobConnection";

    public function selectEdges(DependencyProxyBlobConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new DependencyProxyBlobEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(DependencyProxyBlobConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new DependencyProxyBlobQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(DependencyProxyBlobConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
