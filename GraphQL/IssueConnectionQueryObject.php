<?php

namespace GraphQL\SchemaObject;

class IssueConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "IssueConnection";

    public function selectCount()
    {
        $this->selectField("count");

        return $this;
    }

    public function selectEdges(IssueConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new IssueEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(IssueConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new IssueQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(IssueConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
