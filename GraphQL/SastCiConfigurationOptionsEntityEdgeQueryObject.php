<?php

namespace GraphQL\SchemaObject;

class SastCiConfigurationOptionsEntityEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "SastCiConfigurationOptionsEntityEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(SastCiConfigurationOptionsEntityEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new SastCiConfigurationOptionsEntityQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
