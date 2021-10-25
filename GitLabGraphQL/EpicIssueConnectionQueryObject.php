<?php

namespace GraphQL\SchemaObject;

class EpicIssueConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "EpicIssueConnection";

    public function selectCount()
    {
        $this->selectField("count");

        return $this;
    }

    public function selectEdges(EpicIssueConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new EpicIssueEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(EpicIssueConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new EpicIssueQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(EpicIssueConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectWeight()
    {
        $this->selectField("weight");

        return $this;
    }
}
