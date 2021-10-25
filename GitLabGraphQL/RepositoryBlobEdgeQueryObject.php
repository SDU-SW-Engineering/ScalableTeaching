<?php

namespace GraphQL\SchemaObject;

class RepositoryBlobEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "RepositoryBlobEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(RepositoryBlobEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new RepositoryBlobQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
