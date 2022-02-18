<?php

namespace GraphQL\SchemaObject;

class MilestoneConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "MilestoneConnection";

    public function selectEdges(MilestoneConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new MilestoneEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(MilestoneConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new MilestoneQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(MilestoneConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
