<?php

namespace GraphQL\SchemaObject;

class SastCiConfigurationAnalyzersEntityEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "SastCiConfigurationAnalyzersEntityEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(SastCiConfigurationAnalyzersEntityEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new SastCiConfigurationAnalyzersEntityQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
