<?php

namespace GraphQL\SchemaObject;

class AccessLevelDeployKeyQueryObject extends QueryObject
{
    const OBJECT_NAME = "AccessLevelDeployKey";

    public function selectExpiresAt()
    {
        $this->selectField("expiresAt");

        return $this;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectTitle()
    {
        $this->selectField("title");

        return $this;
    }

    public function selectUser(AccessLevelDeployKeyUserArgumentsObject $argsObject = null)
    {
        $object = new AccessLevelUserQueryObject("user");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
