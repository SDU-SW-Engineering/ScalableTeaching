<?php

namespace GraphQL\SchemaObject;

class CiConfigJobQueryObject extends QueryObject
{
    const OBJECT_NAME = "CiConfigJob";

    public function selectAfterScript()
    {
        $this->selectField("afterScript");

        return $this;
    }

    public function selectAllowFailure()
    {
        $this->selectField("allowFailure");

        return $this;
    }

    public function selectBeforeScript()
    {
        $this->selectField("beforeScript");

        return $this;
    }

    public function selectEnvironment()
    {
        $this->selectField("environment");

        return $this;
    }

    public function selectExcept(CiConfigJobExceptArgumentsObject $argsObject = null)
    {
        $object = new CiConfigJobRestrictionQueryObject("except");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectGroupName()
    {
        $this->selectField("groupName");

        return $this;
    }

    public function selectName()
    {
        $this->selectField("name");

        return $this;
    }

    public function selectNeeds(CiConfigJobNeedsArgumentsObject $argsObject = null)
    {
        $object = new CiConfigNeedConnectionQueryObject("needs");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectOnly(CiConfigJobOnlyArgumentsObject $argsObject = null)
    {
        $object = new CiConfigJobRestrictionQueryObject("only");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectScript()
    {
        $this->selectField("script");

        return $this;
    }

    public function selectStage()
    {
        $this->selectField("stage");

        return $this;
    }

    public function selectTags()
    {
        $this->selectField("tags");

        return $this;
    }

    public function selectWhen()
    {
        $this->selectField("when");

        return $this;
    }
}
