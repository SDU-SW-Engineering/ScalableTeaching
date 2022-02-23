<?php

namespace GraphQL\SchemaObject;

class PipelineSecurityReportFindingEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "PipelineSecurityReportFindingEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(PipelineSecurityReportFindingEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new PipelineSecurityReportFindingQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
