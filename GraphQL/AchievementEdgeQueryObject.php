<?php

namespace GraphQL\SchemaObject;

class AchievementEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "AchievementEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(AchievementEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new AchievementQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
