<?php

namespace GraphQL\SchemaObject;

class WorkItemConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "WorkItemConnection";

    public function selectEdges(WorkItemConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new WorkItemEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(WorkItemConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new WorkItemQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(WorkItemConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
