<?php

namespace GraphQL\SchemaObject;

class SentryErrorEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "SentryErrorEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(SentryErrorEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new SentryErrorQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
