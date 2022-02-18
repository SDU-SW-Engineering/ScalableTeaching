<?php

namespace GraphQL\SchemaObject;

class GroupStatsQueryObject extends QueryObject
{
    const OBJECT_NAME = "GroupStats";

    public function selectReleaseStats(GroupStatsReleaseStatsArgumentsObject $argsObject = null)
    {
        $object = new GroupReleaseStatsQueryObject("releaseStats");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
