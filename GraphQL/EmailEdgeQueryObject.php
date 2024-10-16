<?php

namespace GraphQL\SchemaObject;

class EmailEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "EmailEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(EmailEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new EmailQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
