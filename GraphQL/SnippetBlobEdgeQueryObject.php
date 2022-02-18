<?php

namespace GraphQL\SchemaObject;

class SnippetBlobEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "SnippetBlobEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(SnippetBlobEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new SnippetBlobQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
