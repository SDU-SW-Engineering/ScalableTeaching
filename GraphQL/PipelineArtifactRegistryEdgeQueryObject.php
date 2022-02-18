<?php

namespace GraphQL\SchemaObject;

class PipelineArtifactRegistryEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "PipelineArtifactRegistryEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(PipelineArtifactRegistryEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new PipelineArtifactRegistryQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
