<?php

namespace GraphQL\SchemaObject;

class CommitEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "CommitEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(CommitEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new CommitQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
