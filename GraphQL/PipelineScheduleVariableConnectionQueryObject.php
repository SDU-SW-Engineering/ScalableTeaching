<?php

namespace GraphQL\SchemaObject;

class PipelineScheduleVariableConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "PipelineScheduleVariableConnection";

    public function selectEdges(PipelineScheduleVariableConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new PipelineScheduleVariableEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(PipelineScheduleVariableConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new PipelineScheduleVariableQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(PipelineScheduleVariableConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
