<?php

namespace GraphQL\SchemaObject;

class ApiFuzzingCiConfigurationQueryObject extends QueryObject
{
    const OBJECT_NAME = "ApiFuzzingCiConfiguration";

    public function selectScanModes()
    {
        $this->selectField("scanModes");

        return $this;
    }

    public function selectScanProfiles(ApiFuzzingCiConfigurationScanProfilesArgumentsObject $argsObject = null)
    {
        $object = new ApiFuzzingScanProfileQueryObject("scanProfiles");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
