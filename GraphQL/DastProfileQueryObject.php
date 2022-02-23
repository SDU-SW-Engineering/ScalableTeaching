<?php

namespace GraphQL\SchemaObject;

class DastProfileQueryObject extends QueryObject
{
    const OBJECT_NAME = "DastProfile";

    public function selectBranch(DastProfileBranchArgumentsObject $argsObject = null)
    {
        $object = new DastProfileBranchQueryObject("branch");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectDastProfileSchedule(DastProfileDastProfileScheduleArgumentsObject $argsObject = null)
    {
        $object = new DastProfileScheduleQueryObject("dastProfileSchedule");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectDastScannerProfile(DastProfileDastScannerProfileArgumentsObject $argsObject = null)
    {
        $object = new DastScannerProfileQueryObject("dastScannerProfile");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectDastSiteProfile(DastProfileDastSiteProfileArgumentsObject $argsObject = null)
    {
        $object = new DastSiteProfileQueryObject("dastSiteProfile");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectDescription()
    {
        $this->selectField("description");

        return $this;
    }

    public function selectEditPath()
    {
        $this->selectField("editPath");

        return $this;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectName()
    {
        $this->selectField("name");

        return $this;
    }
}
