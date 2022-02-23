<?php

namespace GraphQL\SchemaObject;

class SastCiConfigurationQueryObject extends QueryObject
{
    const OBJECT_NAME = "SastCiConfiguration";

    public function selectAnalyzers(SastCiConfigurationAnalyzersArgumentsObject $argsObject = null)
    {
        $object = new SastCiConfigurationAnalyzersEntityConnectionQueryObject("analyzers");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectGlobal(SastCiConfigurationGlobalArgumentsObject $argsObject = null)
    {
        $object = new SastCiConfigurationEntityConnectionQueryObject("global");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPipeline(SastCiConfigurationPipelineArgumentsObject $argsObject = null)
    {
        $object = new SastCiConfigurationEntityConnectionQueryObject("pipeline");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
