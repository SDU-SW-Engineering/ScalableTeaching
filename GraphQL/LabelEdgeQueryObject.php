<?php

namespace GraphQL\SchemaObject;

class LabelEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "LabelEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(LabelEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new LabelQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
