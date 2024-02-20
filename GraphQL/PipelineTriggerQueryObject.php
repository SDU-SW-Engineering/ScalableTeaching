<?php

namespace GraphQL\SchemaObject;

class PipelineTriggerQueryObject extends QueryObject
{
    const OBJECT_NAME = "PipelineTrigger";

    public function selectCanAccessProject()
    {
        $this->selectField("canAccessProject");

        return $this;
    }

    public function selectDescription()
    {
        $this->selectField("description");

        return $this;
    }

    public function selectHasTokenExposed()
    {
        $this->selectField("hasTokenExposed");

        return $this;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectLastUsed()
    {
        $this->selectField("lastUsed");

        return $this;
    }

    public function selectOwner(PipelineTriggerOwnerArgumentsObject $argsObject = null)
    {
        $object = new UserCoreQueryObject("owner");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectToken()
    {
        $this->selectField("token");

        return $this;
    }
}
