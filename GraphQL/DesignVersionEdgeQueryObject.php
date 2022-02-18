<?php

namespace GraphQL\SchemaObject;

class DesignVersionEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "DesignVersionEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(DesignVersionEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new DesignVersionQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
