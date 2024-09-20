<?php

namespace GraphQL\SchemaObject;

class PipelineTriggerConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "PipelineTriggerConnection";

    public function selectCount()
    {
        $this->selectField("count");

        return $this;
    }

    public function selectEdges(PipelineTriggerConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new PipelineTriggerEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(PipelineTriggerConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new PipelineTriggerQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(PipelineTriggerConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
