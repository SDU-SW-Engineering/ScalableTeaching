<?php

namespace GraphQL\SchemaObject;

class CiConfigGroupQueryObject extends QueryObject
{
    const OBJECT_NAME = "CiConfigGroup";

    public function selectJobs(CiConfigGroupJobsArgumentsObject $argsObject = null)
    {
        $object = new CiConfigJobConnectionQueryObject("jobs");
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
