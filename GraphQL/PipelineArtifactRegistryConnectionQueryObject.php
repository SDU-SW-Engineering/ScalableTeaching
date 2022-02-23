<?php

namespace GraphQL\SchemaObject;

class PipelineArtifactRegistryConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "PipelineArtifactRegistryConnection";

    public function selectEdges(PipelineArtifactRegistryConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new PipelineArtifactRegistryEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(PipelineArtifactRegistryConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new PipelineArtifactRegistryQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(PipelineArtifactRegistryConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
