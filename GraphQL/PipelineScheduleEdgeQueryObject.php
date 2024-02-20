<?php

namespace GraphQL\SchemaObject;

class PipelineScheduleEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "PipelineScheduleEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(PipelineScheduleEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new PipelineScheduleQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
