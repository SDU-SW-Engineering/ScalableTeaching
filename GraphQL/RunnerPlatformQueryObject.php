<?php

namespace GraphQL\SchemaObject;

class RunnerPlatformQueryObject extends QueryObject
{
    const OBJECT_NAME = "RunnerPlatform";

    public function selectArchitectures(RunnerPlatformArchitecturesArgumentsObject $argsObject = null)
    {
        $object = new RunnerArchitectureConnectionQueryObject("architectures");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectHumanReadableName()
    {
        $this->selectField("humanReadableName");

        return $this;
    }

    public function selectName()
    {
        $this->selectField("name");

        return $this;
    }
}
