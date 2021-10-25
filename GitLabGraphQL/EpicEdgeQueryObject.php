<?php

namespace GraphQL\SchemaObject;

class EpicEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "EpicEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(EpicEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new EpicQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
