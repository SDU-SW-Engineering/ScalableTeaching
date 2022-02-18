<?php

namespace GraphQL\SchemaObject;

class SastCiConfigurationEntityQueryObject extends QueryObject
{
    const OBJECT_NAME = "SastCiConfigurationEntity";

    public function selectDefaultValue()
    {
        $this->selectField("defaultValue");

        return $this;
    }

    public function selectDescription()
    {
        $this->selectField("description");

        return $this;
    }

    public function selectField()
    {
        $this->selectField("field");

        return $this;
    }

    public function selectLabel()
    {
        $this->selectField("label");

        return $this;
    }

    public function selectOptions(SastCiConfigurationEntityOptionsArgumentsObject $argsObject = null)
    {
        $object = new SastCiConfigurationOptionsEntityConnectionQueryObject("options");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSize()
    {
        $this->selectField("size");

        return $this;
    }

    public function selectType()
    {
        $this->selectField("type");

        return $this;
    }

    public function selectValue()
    {
        $this->selectField("value");

        return $this;
    }
}
