<?php

namespace GraphQL\SchemaObject;

class CiStageQueryObject extends QueryObject
{
    const OBJECT_NAME = "CiStage";

    public function selectDetailedStatus(CiStageDetailedStatusArgumentsObject $argsObject = null)
    {
        $object = new DetailedStatusQueryObject("detailedStatus");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectGroups(CiStageGroupsArgumentsObject $argsObject = null)
    {
        $object = new CiGroupConnectionQueryObject("groups");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectJobs(CiStageJobsArgumentsObject $argsObject = null)
    {
        $object = new CiJobConnectionQueryObject("jobs");
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

    public function selectStatus()
    {
        $this->selectField("status");

        return $this;
    }
}
