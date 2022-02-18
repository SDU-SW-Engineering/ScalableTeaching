<?php

namespace GraphQL\SchemaObject;

class TodoEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "TodoEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(TodoEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new TodoQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
