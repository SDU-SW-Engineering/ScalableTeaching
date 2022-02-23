<?php

namespace GraphQL\SchemaObject;

class PipelineQueryObject extends QueryObject
{
    const OBJECT_NAME = "Pipeline";

    public function selectActive()
    {
        $this->selectField("active");

        return $this;
    }

    public function selectBeforeSha()
    {
        $this->selectField("beforeSha");

        return $this;
    }

    public function selectCancelable()
    {
        $this->selectField("cancelable");

        return $this;
    }

    public function selectCodeQualityReports(PipelineCodeQualityReportsArgumentsObject $argsObject = null)
    {
        $object = new CodeQualityDegradationConnectionQueryObject("codeQualityReports");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCommit(PipelineCommitArgumentsObject $argsObject = null)
    {
        $object = new CommitQueryObject("commit");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCommitPath()
    {
        $this->selectField("commitPath");

        return $this;
    }

    public function selectCommittedAt()
    {
        $this->selectField("committedAt");

        return $this;
    }

    public function selectComplete()
    {
        $this->selectField("complete");

        return $this;
    }

    public function selectConfigSource()
    {
        $this->selectField("configSource");

        return $this;
    }

    public function selectCoverage()
    {
        $this->selectField("coverage");

        return $this;
    }

    public function selectCreatedAt()
    {
        $this->selectField("createdAt");

        return $this;
    }

    public function selectDastProfile(PipelineDastProfileArgumentsObject $argsObject = null)
    {
        $object = new DastProfileQueryObject("dastProfile");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectDetailedStatus(PipelineDetailedStatusArgumentsObject $argsObject = null)
    {
        $object = new DetailedStatusQueryObject("detailedStatus");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectDownstream(PipelineDownstreamArgumentsObject $argsObject = null)
    {
        $object = new PipelineConnectionQueryObject("downstream");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectDuration()
    {
        $this->selectField("duration");

        return $this;
    }

    public function selectFinishedAt()
    {
        $this->selectField("finishedAt");

        return $this;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectIid()
    {
        $this->selectField("iid");

        return $this;
    }

    public function selectJob(PipelineJobArgumentsObject $argsObject = null)
    {
        $object = new CiJobQueryObject("job");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectJobArtifacts(PipelineJobArtifactsArgumentsObject $argsObject = null)
    {
        $object = new CiJobArtifactQueryObject("jobArtifacts");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectJobs(PipelineJobsArgumentsObject $argsObject = null)
    {
        $object = new CiJobConnectionQueryObject("jobs");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPath()
    {
        $this->selectField("path");

        return $this;
    }

    public function selectProject(PipelineProjectArgumentsObject $argsObject = null)
    {
        $object = new ProjectQueryObject("project");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectQueuedDuration()
    {
        $this->selectField("queuedDuration");

        return $this;
    }

    public function selectRef()
    {
        $this->selectField("ref");

        return $this;
    }

    public function selectRefPath()
    {
        $this->selectField("refPath");

        return $this;
    }

    public function selectRetryable()
    {
        $this->selectField("retryable");

        return $this;
    }

    public function selectSecurityReportFindings(PipelineSecurityReportFindingsArgumentsObject $argsObject = null)
    {
        $object = new PipelineSecurityReportFindingConnectionQueryObject("securityReportFindings");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSecurityReportSummary(PipelineSecurityReportSummaryArgumentsObject $argsObject = null)
    {
        $object = new SecurityReportSummaryQueryObject("securityReportSummary");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSha()
    {
        $this->selectField("sha");

        return $this;
    }

    public function selectSourceJob(PipelineSourceJobArgumentsObject $argsObject = null)
    {
        $object = new CiJobQueryObject("sourceJob");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectStages(PipelineStagesArgumentsObject $argsObject = null)
    {
        $object = new CiStageConnectionQueryObject("stages");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectStartedAt()
    {
        $this->selectField("startedAt");

        return $this;
    }

    public function selectStatus()
    {
        $this->selectField("status");

        return $this;
    }

    public function selectTestReportSummary(PipelineTestReportSummaryArgumentsObject $argsObject = null)
    {
        $object = new TestReportSummaryQueryObject("testReportSummary");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTestSuite(PipelineTestSuiteArgumentsObject $argsObject = null)
    {
        $object = new TestSuiteQueryObject("testSuite");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectUpdatedAt()
    {
        $this->selectField("updatedAt");

        return $this;
    }

    public function selectUpstream(PipelineUpstreamArgumentsObject $argsObject = null)
    {
        $object = new PipelineQueryObject("upstream");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectUser(PipelineUserArgumentsObject $argsObject = null)
    {
        $object = new UserCoreQueryObject("user");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectUserPermissions(PipelineUserPermissionsArgumentsObject $argsObject = null)
    {
        $object = new PipelinePermissionsQueryObject("userPermissions");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectUsesNeeds()
    {
        $this->selectField("usesNeeds");

        return $this;
    }

    public function selectWarningMessages(PipelineWarningMessagesArgumentsObject $argsObject = null)
    {
        $object = new PipelineMessageQueryObject("warningMessages");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectWarnings()
    {
        $this->selectField("warnings");

        return $this;
    }
}
