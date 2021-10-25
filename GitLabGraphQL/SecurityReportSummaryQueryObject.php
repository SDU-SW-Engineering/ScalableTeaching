<?php

namespace GraphQL\SchemaObject;

class SecurityReportSummaryQueryObject extends QueryObject
{
    const OBJECT_NAME = "SecurityReportSummary";

    public function selectApiFuzzing(SecurityReportSummaryApiFuzzingArgumentsObject $argsObject = null)
    {
        $object = new SecurityReportSummarySectionQueryObject("apiFuzzing");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectClusterImageScanning(SecurityReportSummaryClusterImageScanningArgumentsObject $argsObject = null)
    {
        $object = new SecurityReportSummarySectionQueryObject("clusterImageScanning");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectContainerScanning(SecurityReportSummaryContainerScanningArgumentsObject $argsObject = null)
    {
        $object = new SecurityReportSummarySectionQueryObject("containerScanning");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCoverageFuzzing(SecurityReportSummaryCoverageFuzzingArgumentsObject $argsObject = null)
    {
        $object = new SecurityReportSummarySectionQueryObject("coverageFuzzing");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectDast(SecurityReportSummaryDastArgumentsObject $argsObject = null)
    {
        $object = new SecurityReportSummarySectionQueryObject("dast");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectDependencyScanning(SecurityReportSummaryDependencyScanningArgumentsObject $argsObject = null)
    {
        $object = new SecurityReportSummarySectionQueryObject("dependencyScanning");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectGeneric(SecurityReportSummaryGenericArgumentsObject $argsObject = null)
    {
        $object = new SecurityReportSummarySectionQueryObject("generic");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSast(SecurityReportSummarySastArgumentsObject $argsObject = null)
    {
        $object = new SecurityReportSummarySectionQueryObject("sast");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSecretDetection(SecurityReportSummarySecretDetectionArgumentsObject $argsObject = null)
    {
        $object = new SecurityReportSummarySectionQueryObject("secretDetection");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
