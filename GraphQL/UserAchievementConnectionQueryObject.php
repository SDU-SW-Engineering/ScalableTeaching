<?php

namespace GraphQL\SchemaObject;

class UserAchievementConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "UserAchievementConnection";

    public function selectCount()
    {
        $this->selectField("count");

        return $this;
    }

    public function selectEdges(UserAchievementConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new UserAchievementEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(UserAchievementConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new UserAchievementQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(UserAchievementConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
