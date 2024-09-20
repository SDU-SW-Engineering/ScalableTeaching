<?php

namespace GraphQL\SchemaObject;

class PushAccessLevelQueryObject extends QueryObject
{
    const OBJECT_NAME = "PushAccessLevel";

    public function selectAccessLevel()
    {
        $this->selectField("accessLevel");

        return $this;
    }

    public function selectAccessLevelDescription()
    {
        $this->selectField("accessLevelDescription");

        return $this;
    }

    public function selectDeployKey(PushAccessLevelDeployKeyArgumentsObject $argsObject = null)
    {
        $object = new AccessLevelDeployKeyQueryObject("deployKey");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
