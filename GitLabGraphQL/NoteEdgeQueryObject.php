<?php

namespace GraphQL\SchemaObject;

class NoteEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "NoteEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(NoteEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new NoteQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
