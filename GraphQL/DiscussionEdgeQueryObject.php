<?php

namespace GraphQL\SchemaObject;

class DiscussionEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "DiscussionEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(DiscussionEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new DiscussionQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
