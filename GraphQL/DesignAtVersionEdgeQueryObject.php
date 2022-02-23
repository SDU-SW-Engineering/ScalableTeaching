<?php

namespace GraphQL\SchemaObject;

class DesignAtVersionEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "DesignAtVersionEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(DesignAtVersionEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new DesignAtVersionQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
