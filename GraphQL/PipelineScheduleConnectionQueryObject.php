<?php

namespace GraphQL\SchemaObject;

class PipelineScheduleConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "PipelineScheduleConnection";

    public function selectCount()
    {
        $this->selectField("count");

        return $this;
    }

    public function selectEdges(PipelineScheduleConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new PipelineScheduleEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(PipelineScheduleConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new PipelineScheduleQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(PipelineScheduleConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
