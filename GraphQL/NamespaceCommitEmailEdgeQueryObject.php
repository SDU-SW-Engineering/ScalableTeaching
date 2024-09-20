<?php

namespace GraphQL\SchemaObject;

class NamespaceCommitEmailEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "NamespaceCommitEmailEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(NamespaceCommitEmailEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new NamespaceCommitEmailQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
