<?php

namespace GraphQL\SchemaObject;

class PipelineConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "PipelineConnection";

    public function selectCount()
    {
        $this->selectField("count");

        return $this;
    }

    public function selectEdges(PipelineConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new PipelineEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(PipelineConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new PipelineQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(PipelineConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
