<?php

namespace GraphQL\SchemaObject;

class NestedEnvironmentQueryObject extends QueryObject
{
    const OBJECT_NAME = "NestedEnvironment";

    public function selectEnvironment(NestedEnvironmentEnvironmentArgumentsObject $argsObject = null)
    {
        $object = new EnvironmentQueryObject("environment");
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

    public function selectSize()
    {
        $this->selectField("size");

        return $this;
    }
}
