<?php

namespace GraphQL\SchemaObject;

class GroupMemberConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "GroupMemberConnection";

    public function selectEdges(GroupMemberConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new GroupMemberEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(GroupMemberConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new GroupMemberQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(GroupMemberConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
