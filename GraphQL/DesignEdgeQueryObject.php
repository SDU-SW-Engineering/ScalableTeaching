<?php

namespace GraphQL\SchemaObject;

class DesignEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "DesignEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(DesignEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new DesignQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
