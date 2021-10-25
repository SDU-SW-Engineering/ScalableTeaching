<?php

namespace GraphQL\SchemaObject;

class PipelineSecurityReportFindingConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "PipelineSecurityReportFindingConnection";

    public function selectEdges(PipelineSecurityReportFindingConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new PipelineSecurityReportFindingEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(PipelineSecurityReportFindingConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new PipelineSecurityReportFindingQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(PipelineSecurityReportFindingConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
