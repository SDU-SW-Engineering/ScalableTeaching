<?php

namespace GraphQL\SchemaObject;

class MergeRequestEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "MergeRequestEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(MergeRequestEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new MergeRequestQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
