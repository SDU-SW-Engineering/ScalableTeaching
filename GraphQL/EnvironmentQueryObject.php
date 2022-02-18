<?php

namespace GraphQL\SchemaObject;

class EnvironmentQueryObject extends QueryObject
{
    const OBJECT_NAME = "Environment";

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectLatestOpenedMostSevereAlert(EnvironmentLatestOpenedMostSevereAlertArgumentsObject $argsObject = null)
    {
        $object = new AlertManagementAlertQueryObject("latestOpenedMostSevereAlert");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectMetricsDashboard(EnvironmentMetricsDashboardArgumentsObject $argsObject = null)
    {
        $object = new MetricsDashboardQueryObject("metricsDashboard");
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

    public function selectPath()
    {
        $this->selectField("path");

        return $this;
    }

    public function selectState()
    {
        $this->selectField("state");

        return $this;
    }
}
