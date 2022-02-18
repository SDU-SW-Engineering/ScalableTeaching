<?php

namespace GraphQL\SchemaObject;

class CiConfigQueryObject extends QueryObject
{
    const OBJECT_NAME = "CiConfig";

    public function selectErrors()
    {
        $this->selectField("errors");

        return $this;
    }

    public function selectMergedYaml()
    {
        $this->selectField("mergedYaml");

        return $this;
    }

    public function selectStages(CiConfigStagesArgumentsObject $argsObject = null)
    {
        $object = new CiConfigStageConnectionQueryObject("stages");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectStatus()
    {
        $this->selectField("status");

        return $this;
    }

    public function selectWarnings()
    {
        $this->selectField("warnings");

        return $this;
    }
}
