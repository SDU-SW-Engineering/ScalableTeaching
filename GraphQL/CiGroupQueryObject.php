<?php

namespace GraphQL\SchemaObject;

class CiGroupQueryObject extends QueryObject
{
    const OBJECT_NAME = "CiGroup";

    public function selectDetailedStatus(CiGroupDetailedStatusArgumentsObject $argsObject = null)
    {
        $object = new DetailedStatusQueryObject("detailedStatus");
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

    public function selectJobs(CiGroupJobsArgumentsObject $argsObject = null)
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

    public function selectSize()
    {
        $this->selectField("size");

        return $this;
    }
}
