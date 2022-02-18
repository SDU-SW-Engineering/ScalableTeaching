<?php

namespace GraphQL\SchemaObject;

class LfsObjectRegistryEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "LfsObjectRegistryEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(LfsObjectRegistryEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new LfsObjectRegistryQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
