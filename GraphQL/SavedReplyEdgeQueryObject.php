<?php

namespace GraphQL\SchemaObject;

class SavedReplyEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "SavedReplyEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(SavedReplyEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new SavedReplyQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
