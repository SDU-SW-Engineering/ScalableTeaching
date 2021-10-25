<?php

namespace GraphQL\SchemaObject;

class DevopsAdoptionSnapshotQueryObject extends QueryObject
{
    const OBJECT_NAME = "DevopsAdoptionSnapshot";

    public function selectCodeOwnersUsedCount()
    {
        $this->selectField("codeOwnersUsedCount");

        return $this;
    }

    public function selectCoverageFuzzingEnabledCount()
    {
        $this->selectField("coverageFuzzingEnabledCount");

        return $this;
    }

    public function selectDastEnabledCount()
    {
        $this->selectField("dastEnabledCount");

        return $this;
    }

    public function selectDependencyScanningEnabledCount()
    {
        $this->selectField("dependencyScanningEnabledCount");

        return $this;
    }

    public function selectDeploySucceeded()
    {
        $this->selectField("deploySucceeded");

        return $this;
    }

    public function selectEndTime()
    {
        $this->selectField("endTime");

        return $this;
    }

    public function selectIssueOpened()
    {
        $this->selectField("issueOpened");

        return $this;
    }

    public function selectMergeRequestApproved()
    {
        $this->selectField("mergeRequestApproved");

        return $this;
    }

    public function selectMergeRequestOpened()
    {
        $this->selectField("mergeRequestOpened");

        return $this;
    }

    public function selectPipelineSucceeded()
    {
        $this->selectField("pipelineSucceeded");

        return $this;
    }

    public function selectRecordedAt()
    {
        $this->selectField("recordedAt");

        return $this;
    }

    public function selectRunnerConfigured()
    {
        $this->selectField("runnerConfigured");

        return $this;
    }

    public function selectSastEnabledCount()
    {
        $this->selectField("sastEnabledCount");

        return $this;
    }

    /**
     * @deprecated Substituted with specific security metrics. Always false. Deprecated in 14.1.
     */
    public function selectSecurityScanSucceeded()
    {
        $this->selectField("securityScanSucceeded");

        return $this;
    }

    public function selectStartTime()
    {
        $this->selectField("startTime");

        return $this;
    }

    public function selectTotalProjectsCount()
    {
        $this->selectField("totalProjectsCount");

        return $this;
    }

    public function selectVulnerabilityManagementUsedCount()
    {
        $this->selectField("vulnerabilityManagementUsedCount");

        return $this;
    }
}
