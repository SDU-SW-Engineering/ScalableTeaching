<?php

namespace GraphQL\SchemaObject;

class SastCiConfigurationAnalyzersEntityQueryObject extends QueryObject
{
    const OBJECT_NAME = "SastCiConfigurationAnalyzersEntity";

    public function selectDescription()
    {
        $this->selectField("description");

        return $this;
    }

    public function selectEnabled()
    {
        $this->selectField("enabled");

        return $this;
    }

    public function selectLabel()
    {
        $this->selectField("label");

        return $this;
    }

    public function selectName()
    {
        $this->selectField("name");

        return $this;
    }

    public function selectVariables(SastCiConfigurationAnalyzersEntityVariablesArgumentsObject $argsObject = null)
    {
        $object = new SastCiConfigurationEntityConnectionQueryObject("variables");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
