<?php

namespace GraphQL\SchemaObject;

class DependencyProxyManifestConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "DependencyProxyManifestConnection";

    public function selectEdges(DependencyProxyManifestConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new DependencyProxyManifestEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(DependencyProxyManifestConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new DependencyProxyManifestQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(DependencyProxyManifestConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
