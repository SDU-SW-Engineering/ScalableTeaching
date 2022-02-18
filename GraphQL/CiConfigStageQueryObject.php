<?php

namespace GraphQL\SchemaObject;

class CiConfigStageQueryObject extends QueryObject
{
    const OBJECT_NAME = "CiConfigStage";

    public function selectGroups(CiConfigStageGroupsArgumentsObject $argsObject = null)
    {
        $object = new CiConfigGroupConnectionQueryObject("groups");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectName()
    {
        $this->selectField("name");

        return $this;
    }
}
