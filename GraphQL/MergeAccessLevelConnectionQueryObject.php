<?php

namespace GraphQL\SchemaObject;

class MergeAccessLevelConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "MergeAccessLevelConnection";

    public function selectEdges(MergeAccessLevelConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new MergeAccessLevelEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(MergeAccessLevelConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new MergeAccessLevelQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(MergeAccessLevelConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
