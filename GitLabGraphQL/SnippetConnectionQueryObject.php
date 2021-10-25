<?php

namespace GraphQL\SchemaObject;

class SnippetConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "SnippetConnection";

    public function selectEdges(SnippetConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new SnippetEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(SnippetConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new SnippetQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(SnippetConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
