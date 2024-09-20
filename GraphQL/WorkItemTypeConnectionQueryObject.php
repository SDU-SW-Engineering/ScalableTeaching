<?php

namespace GraphQL\SchemaObject;

class WorkItemTypeConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "WorkItemTypeConnection";

    public function selectEdges(WorkItemTypeConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new WorkItemTypeEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(WorkItemTypeConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new WorkItemTypeQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(WorkItemTypeConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
