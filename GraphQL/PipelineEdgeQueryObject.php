<?php

namespace GraphQL\SchemaObject;

class PipelineEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "PipelineEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(PipelineEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new PipelineQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
