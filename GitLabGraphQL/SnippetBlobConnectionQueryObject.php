<?php

namespace GraphQL\SchemaObject;

class SnippetBlobConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "SnippetBlobConnection";

    public function selectEdges(SnippetBlobConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new SnippetBlobEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(SnippetBlobConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new SnippetBlobQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(SnippetBlobConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
