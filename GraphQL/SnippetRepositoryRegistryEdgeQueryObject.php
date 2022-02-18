<?php

namespace GraphQL\SchemaObject;

class SnippetRepositoryRegistryEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "SnippetRepositoryRegistryEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(SnippetRepositoryRegistryEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new SnippetRepositoryRegistryQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
