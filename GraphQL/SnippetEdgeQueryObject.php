<?php

namespace GraphQL\SchemaObject;

class SnippetEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "SnippetEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(SnippetEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new SnippetQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
