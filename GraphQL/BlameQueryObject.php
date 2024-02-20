<?php

namespace GraphQL\SchemaObject;

class BlameQueryObject extends QueryObject
{
    const OBJECT_NAME = "Blame";

    public function selectFirstLine()
    {
        $this->selectField("firstLine");

        return $this;
    }

    public function selectGroups(BlameGroupsArgumentsObject $argsObject = null)
    {
        $object = new GroupsQueryObject("groups");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
