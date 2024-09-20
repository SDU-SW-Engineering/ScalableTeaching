<?php

namespace GraphQL\SchemaObject;

class PipelineTriggerEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "PipelineTriggerEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(PipelineTriggerEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new PipelineTriggerQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
