<?php

namespace GraphQL\SchemaObject;

class UserCoreConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "UserCoreConnection";

    public function selectCount()
    {
        $this->selectField("count");

        return $this;
    }

    public function selectEdges(UserCoreConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new UserCoreEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(UserCoreConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new UserCoreQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(UserCoreConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
