<?php

namespace GraphQL\SchemaObject;

class MergeRequestAssigneeConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "MergeRequestAssigneeConnection";

    public function selectCount()
    {
        $this->selectField("count");

        return $this;
    }

    public function selectEdges(MergeRequestAssigneeConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new MergeRequestAssigneeEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(MergeRequestAssigneeConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new MergeRequestAssigneeQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(MergeRequestAssigneeConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
