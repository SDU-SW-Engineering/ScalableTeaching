<?php

namespace GraphQL\SchemaObject;

class AchievementConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "AchievementConnection";

    public function selectCount()
    {
        $this->selectField("count");

        return $this;
    }

    public function selectEdges(AchievementConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new AchievementEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(AchievementConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new AchievementQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(AchievementConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
