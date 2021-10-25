<?php

namespace GraphQL\SchemaObject;

class GroupWikiRepositoryRegistryConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "GroupWikiRepositoryRegistryConnection";

    public function selectEdges(GroupWikiRepositoryRegistryConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new GroupWikiRepositoryRegistryEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(GroupWikiRepositoryRegistryConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new GroupWikiRepositoryRegistryQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(GroupWikiRepositoryRegistryConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
