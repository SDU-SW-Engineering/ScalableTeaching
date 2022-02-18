<?php

namespace GraphQL\SchemaObject;

class ScannedResourceEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "ScannedResourceEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(ScannedResourceEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new ScannedResourceQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
