<?php

namespace GraphQL\SchemaObject;

class SnippetRepositoryRegistryConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "SnippetRepositoryRegistryConnection";

    public function selectEdges(SnippetRepositoryRegistryConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new SnippetRepositoryRegistryEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(SnippetRepositoryRegistryConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new SnippetRepositoryRegistryQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(SnippetRepositoryRegistryConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
