<?php

namespace GraphQL\SchemaObject;

class GroupConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "GroupConnection";

    public function selectEdges(GroupConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new GroupEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(GroupConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new GroupQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(GroupConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
