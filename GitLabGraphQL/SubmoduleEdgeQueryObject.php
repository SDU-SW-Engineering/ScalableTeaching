<?php

namespace GraphQL\SchemaObject;

class SubmoduleEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "SubmoduleEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(SubmoduleEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new SubmoduleQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
