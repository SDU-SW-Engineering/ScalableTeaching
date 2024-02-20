<?php

namespace GraphQL\SchemaObject;

class PipelineScheduleVariableEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "PipelineScheduleVariableEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(PipelineScheduleVariableEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new PipelineScheduleVariableQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
