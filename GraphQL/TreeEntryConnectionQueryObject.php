<?php

namespace GraphQL\SchemaObject;

class TreeEntryConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "TreeEntryConnection";

    public function selectEdges(TreeEntryConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new TreeEntryEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(TreeEntryConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new TreeEntryQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(TreeEntryConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
