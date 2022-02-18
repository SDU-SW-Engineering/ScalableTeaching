<?php

namespace GraphQL\SchemaObject;

class PipelineSecurityReportFindingQueryObject extends QueryObject
{
    const OBJECT_NAME = "PipelineSecurityReportFinding";

    public function selectAssets(PipelineSecurityReportFindingAssetsArgumentsObject $argsObject = null)
    {
        $object = new AssetTypeQueryObject("assets");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectConfidence()
    {
        $this->selectField("confidence");

        return $this;
    }

    public function selectDescription()
    {
        $this->selectField("description");

        return $this;
    }

    public function selectEvidence(PipelineSecurityReportFindingEvidenceArgumentsObject $argsObject = null)
    {
        $object = new VulnerabilityEvidenceQueryObject("evidence");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectFalsePositive()
    {
        $this->selectField("falsePositive");

        return $this;
    }

    public function selectIdentifiers(PipelineSecurityReportFindingIdentifiersArgumentsObject $argsObject = null)
    {
        $object = new VulnerabilityIdentifierQueryObject("identifiers");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectLinks(PipelineSecurityReportFindingLinksArgumentsObject $argsObject = null)
    {
        $object = new VulnerabilityLinkQueryObject("links");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectLocation(PipelineSecurityReportFindingLocationArgumentsObject $argsObject = null)
    {
        $object = new VulnerabilityLocationUnionObject("location");
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

    public function selectProject(PipelineSecurityReportFindingProjectArgumentsObject $argsObject = null)
    {
        $object = new ProjectQueryObject("project");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectProjectFingerprint()
    {
        $this->selectField("projectFingerprint");

        return $this;
    }

    public function selectReportType()
    {
        $this->selectField("reportType");

        return $this;
    }

    public function selectScanner(PipelineSecurityReportFindingScannerArgumentsObject $argsObject = null)
    {
        $object = new VulnerabilityScannerQueryObject("scanner");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSeverity()
    {
        $this->selectField("severity");

        return $this;
    }

    public function selectSolution()
    {
        $this->selectField("solution");

        return $this;
    }

    public function selectState()
    {
        $this->selectField("state");

        return $this;
    }

    public function selectTitle()
    {
        $this->selectField("title");

        return $this;
    }

    public function selectUuid()
    {
        $this->selectField("uuid");

        return $this;
    }
}
