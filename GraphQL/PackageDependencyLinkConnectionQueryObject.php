<?php

namespace GraphQL\SchemaObject;

class PackageDependencyLinkConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "PackageDependencyLinkConnection";

    public function selectEdges(PackageDependencyLinkConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new PackageDependencyLinkEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(PackageDependencyLinkConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new PackageDependencyLinkQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(PackageDependencyLinkConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
