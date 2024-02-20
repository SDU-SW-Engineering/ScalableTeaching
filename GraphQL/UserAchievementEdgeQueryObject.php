<?php

namespace GraphQL\SchemaObject;

class UserAchievementEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "UserAchievementEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(UserAchievementEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new UserAchievementQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
