<?php

namespace GraphQL\SchemaObject;

class SastCiConfigurationEntityEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "SastCiConfigurationEntityEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(SastCiConfigurationEntityEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new SastCiConfigurationEntityQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
