<?php

namespace GraphQL\SchemaObject;

class CiMinutesNamespaceMonthlyUsageQueryObject extends QueryObject
{
    const OBJECT_NAME = "CiMinutesNamespaceMonthlyUsage";

    public function selectMinutes()
    {
        $this->selectField("minutes");

        return $this;
    }

    public function selectMonth()
    {
        $this->selectField("month");

        return $this;
    }

    public function selectProjects(CiMinutesNamespaceMonthlyUsageProjectsArgumentsObject $argsObject = null)
    {
        $object = new CiMinutesProjectMonthlyUsageConnectionQueryObject("projects");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
