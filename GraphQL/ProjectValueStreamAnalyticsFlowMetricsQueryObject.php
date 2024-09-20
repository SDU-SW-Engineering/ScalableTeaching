<?php

namespace GraphQL\SchemaObject;

class ProjectValueStreamAnalyticsFlowMetricsQueryObject extends QueryObject
{
    const OBJECT_NAME = "ProjectValueStreamAnalyticsFlowMetrics";

    public function selectDeploymentCount(ProjectValueStreamAnalyticsFlowMetricsDeploymentCountArgumentsObject $argsObject = null)
    {
        $object = new ValueStreamAnalyticsMetricQueryObject("deploymentCount");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectIssueCount(ProjectValueStreamAnalyticsFlowMetricsIssueCountArgumentsObject $argsObject = null)
    {
        $object = new ValueStreamAnalyticsMetricQueryObject("issueCount");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
