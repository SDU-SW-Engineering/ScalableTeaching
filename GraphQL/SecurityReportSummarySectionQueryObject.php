<?php

namespace GraphQL\SchemaObject;

class SecurityReportSummarySectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "SecurityReportSummarySection";

    public function selectScannedResources(SecurityReportSummarySectionScannedResourcesArgumentsObject $argsObject = null)
    {
        $object = new ScannedResourceConnectionQueryObject("scannedResources");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectScannedResourcesCount()
    {
        $this->selectField("scannedResourcesCount");

        return $this;
    }

    public function selectScannedResourcesCsvPath()
    {
        $this->selectField("scannedResourcesCsvPath");

        return $this;
    }

    public function selectScans(SecurityReportSummarySectionScansArgumentsObject $argsObject = null)
    {
        $object = new ScanConnectionQueryObject("scans");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectVulnerabilitiesCount()
    {
        $this->selectField("vulnerabilitiesCount");

        return $this;
    }
}
