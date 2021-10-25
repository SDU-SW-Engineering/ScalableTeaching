<?php

namespace GraphQL\SchemaObject;

class ProjectQueryObject extends QueryObject
{
    const OBJECT_NAME = "Project";

    public function selectActualRepositorySizeLimit()
    {
        $this->selectField("actualRepositorySizeLimit");

        return $this;
    }

    public function selectAgentConfigurations(ProjectAgentConfigurationsArgumentsObject $argsObject = null)
    {
        $object = new AgentConfigurationConnectionQueryObject("agentConfigurations");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectAlertManagementAlert(ProjectAlertManagementAlertArgumentsObject $argsObject = null)
    {
        $object = new AlertManagementAlertQueryObject("alertManagementAlert");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectAlertManagementAlertStatusCounts(ProjectAlertManagementAlertStatusCountsArgumentsObject $argsObject = null)
    {
        $object = new AlertManagementAlertStatusCountsTypeQueryObject("alertManagementAlertStatusCounts");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectAlertManagementAlerts(ProjectAlertManagementAlertsArgumentsObject $argsObject = null)
    {
        $object = new AlertManagementAlertConnectionQueryObject("alertManagementAlerts");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectAlertManagementHttpIntegrations(ProjectAlertManagementHttpIntegrationsArgumentsObject $argsObject = null)
    {
        $object = new AlertManagementHttpIntegrationConnectionQueryObject("alertManagementHttpIntegrations");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectAlertManagementIntegrations(ProjectAlertManagementIntegrationsArgumentsObject $argsObject = null)
    {
        $object = new AlertManagementIntegrationConnectionQueryObject("alertManagementIntegrations");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectAlertManagementPayloadFields(ProjectAlertManagementPayloadFieldsArgumentsObject $argsObject = null)
    {
        $object = new AlertManagementPayloadAlertFieldQueryObject("alertManagementPayloadFields");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectAllowMergeOnSkippedPipeline()
    {
        $this->selectField("allowMergeOnSkippedPipeline");

        return $this;
    }

    public function selectApiFuzzingCiConfiguration(ProjectApiFuzzingCiConfigurationArgumentsObject $argsObject = null)
    {
        $object = new ApiFuzzingCiConfigurationQueryObject("apiFuzzingCiConfiguration");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectArchived()
    {
        $this->selectField("archived");

        return $this;
    }

    public function selectAutocloseReferencedIssues()
    {
        $this->selectField("autocloseReferencedIssues");

        return $this;
    }

    public function selectAvatarUrl()
    {
        $this->selectField("avatarUrl");

        return $this;
    }

    public function selectBoard(ProjectBoardArgumentsObject $argsObject = null)
    {
        $object = new BoardQueryObject("board");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectBoards(ProjectBoardsArgumentsObject $argsObject = null)
    {
        $object = new BoardConnectionQueryObject("boards");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCiCdSettings(ProjectCiCdSettingsArgumentsObject $argsObject = null)
    {
        $object = new ProjectCiCdSettingQueryObject("ciCdSettings");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCiJobTokenScope(ProjectCiJobTokenScopeArgumentsObject $argsObject = null)
    {
        $object = new CiJobTokenScopeTypeQueryObject("ciJobTokenScope");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCiTemplate(ProjectCiTemplateArgumentsObject $argsObject = null)
    {
        $object = new CiTemplateQueryObject("ciTemplate");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectClusterAgent(ProjectClusterAgentArgumentsObject $argsObject = null)
    {
        $object = new ClusterAgentQueryObject("clusterAgent");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectClusterAgents(ProjectClusterAgentsArgumentsObject $argsObject = null)
    {
        $object = new ClusterAgentConnectionQueryObject("clusterAgents");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCodeCoverageSummary(ProjectCodeCoverageSummaryArgumentsObject $argsObject = null)
    {
        $object = new CodeCoverageSummaryQueryObject("codeCoverageSummary");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectComplianceFrameworks(ProjectComplianceFrameworksArgumentsObject $argsObject = null)
    {
        $object = new ComplianceFrameworkConnectionQueryObject("complianceFrameworks");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectContainerExpirationPolicy(ProjectContainerExpirationPolicyArgumentsObject $argsObject = null)
    {
        $object = new ContainerExpirationPolicyQueryObject("containerExpirationPolicy");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectContainerRegistryEnabled()
    {
        $this->selectField("containerRegistryEnabled");

        return $this;
    }

    public function selectContainerRepositories(ProjectContainerRepositoriesArgumentsObject $argsObject = null)
    {
        $object = new ContainerRepositoryConnectionQueryObject("containerRepositories");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectContainerRepositoriesCount()
    {
        $this->selectField("containerRepositoriesCount");

        return $this;
    }

    public function selectCreatedAt()
    {
        $this->selectField("createdAt");

        return $this;
    }

    public function selectDastProfile(ProjectDastProfileArgumentsObject $argsObject = null)
    {
        $object = new DastProfileQueryObject("dastProfile");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectDastProfiles(ProjectDastProfilesArgumentsObject $argsObject = null)
    {
        $object = new DastProfileConnectionQueryObject("dastProfiles");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectDastScannerProfiles(ProjectDastScannerProfilesArgumentsObject $argsObject = null)
    {
        $object = new DastScannerProfileConnectionQueryObject("dastScannerProfiles");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectDastSiteProfile(ProjectDastSiteProfileArgumentsObject $argsObject = null)
    {
        $object = new DastSiteProfileQueryObject("dastSiteProfile");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectDastSiteProfiles(ProjectDastSiteProfilesArgumentsObject $argsObject = null)
    {
        $object = new DastSiteProfileConnectionQueryObject("dastSiteProfiles");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectDastSiteValidations(ProjectDastSiteValidationsArgumentsObject $argsObject = null)
    {
        $object = new DastSiteValidationConnectionQueryObject("dastSiteValidations");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectDescription()
    {
        $this->selectField("description");

        return $this;
    }

    public function selectDescriptionHtml()
    {
        $this->selectField("descriptionHtml");

        return $this;
    }

    public function selectDora(ProjectDoraArgumentsObject $argsObject = null)
    {
        $object = new DoraQueryObject("dora");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectEnvironment(ProjectEnvironmentArgumentsObject $argsObject = null)
    {
        $object = new EnvironmentQueryObject("environment");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectEnvironments(ProjectEnvironmentsArgumentsObject $argsObject = null)
    {
        $object = new EnvironmentConnectionQueryObject("environments");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectForksCount()
    {
        $this->selectField("forksCount");

        return $this;
    }

    public function selectFullPath()
    {
        $this->selectField("fullPath");

        return $this;
    }

    public function selectGrafanaIntegration(ProjectGrafanaIntegrationArgumentsObject $argsObject = null)
    {
        $object = new GrafanaIntegrationQueryObject("grafanaIntegration");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectGroup(ProjectGroupArgumentsObject $argsObject = null)
    {
        $object = new GroupQueryObject("group");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectHttpUrlToRepo()
    {
        $this->selectField("httpUrlToRepo");

        return $this;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectImportStatus()
    {
        $this->selectField("importStatus");

        return $this;
    }

    public function selectIncidentManagementEscalationPolicies(ProjectIncidentManagementEscalationPoliciesArgumentsObject $argsObject = null)
    {
        $object = new EscalationPolicyTypeConnectionQueryObject("incidentManagementEscalationPolicies");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectIncidentManagementEscalationPolicy(ProjectIncidentManagementEscalationPolicyArgumentsObject $argsObject = null)
    {
        $object = new EscalationPolicyTypeQueryObject("incidentManagementEscalationPolicy");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectIncidentManagementOncallSchedules(ProjectIncidentManagementOncallSchedulesArgumentsObject $argsObject = null)
    {
        $object = new IncidentManagementOncallScheduleConnectionQueryObject("incidentManagementOncallSchedules");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectIssue(ProjectIssueArgumentsObject $argsObject = null)
    {
        $object = new IssueQueryObject("issue");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectIssueStatusCounts(ProjectIssueStatusCountsArgumentsObject $argsObject = null)
    {
        $object = new IssueStatusCountsTypeQueryObject("issueStatusCounts");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectIssues(ProjectIssuesArgumentsObject $argsObject = null)
    {
        $object = new IssueConnectionQueryObject("issues");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectIssuesEnabled()
    {
        $this->selectField("issuesEnabled");

        return $this;
    }

    public function selectIterationCadences(ProjectIterationCadencesArgumentsObject $argsObject = null)
    {
        $object = new IterationCadenceConnectionQueryObject("iterationCadences");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectIterations(ProjectIterationsArgumentsObject $argsObject = null)
    {
        $object = new IterationConnectionQueryObject("iterations");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectJiraImportStatus()
    {
        $this->selectField("jiraImportStatus");

        return $this;
    }

    public function selectJiraImports(ProjectJiraImportsArgumentsObject $argsObject = null)
    {
        $object = new JiraImportConnectionQueryObject("jiraImports");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectJobs(ProjectJobsArgumentsObject $argsObject = null)
    {
        $object = new CiJobConnectionQueryObject("jobs");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectJobsEnabled()
    {
        $this->selectField("jobsEnabled");

        return $this;
    }

    public function selectLabel(ProjectLabelArgumentsObject $argsObject = null)
    {
        $object = new LabelQueryObject("label");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectLabels(ProjectLabelsArgumentsObject $argsObject = null)
    {
        $object = new LabelConnectionQueryObject("labels");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectLastActivityAt()
    {
        $this->selectField("lastActivityAt");

        return $this;
    }

    public function selectLfsEnabled()
    {
        $this->selectField("lfsEnabled");

        return $this;
    }

    public function selectMergeRequest(ProjectMergeRequestArgumentsObject $argsObject = null)
    {
        $object = new MergeRequestQueryObject("mergeRequest");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectMergeRequests(ProjectMergeRequestsArgumentsObject $argsObject = null)
    {
        $object = new MergeRequestConnectionQueryObject("mergeRequests");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectMergeRequestsEnabled()
    {
        $this->selectField("mergeRequestsEnabled");

        return $this;
    }

    public function selectMergeRequestsFfOnlyEnabled()
    {
        $this->selectField("mergeRequestsFfOnlyEnabled");

        return $this;
    }

    public function selectMilestones(ProjectMilestonesArgumentsObject $argsObject = null)
    {
        $object = new MilestoneConnectionQueryObject("milestones");
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

    public function selectNameWithNamespace()
    {
        $this->selectField("nameWithNamespace");

        return $this;
    }

    public function selectNamespace(ProjectNamespaceArgumentsObject $argsObject = null)
    {
        $object = new NamespaceQueryObject("namespace");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNetworkPolicies(ProjectNetworkPoliciesArgumentsObject $argsObject = null)
    {
        $object = new NetworkPolicyConnectionQueryObject("networkPolicies");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectOnlyAllowMergeIfAllDiscussionsAreResolved()
    {
        $this->selectField("onlyAllowMergeIfAllDiscussionsAreResolved");

        return $this;
    }

    public function selectOnlyAllowMergeIfPipelineSucceeds()
    {
        $this->selectField("onlyAllowMergeIfPipelineSucceeds");

        return $this;
    }

    public function selectOpenIssuesCount()
    {
        $this->selectField("openIssuesCount");

        return $this;
    }

    public function selectPackages(ProjectPackagesArgumentsObject $argsObject = null)
    {
        $object = new PackageConnectionQueryObject("packages");
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

    public function selectPathLocks(ProjectPathLocksArgumentsObject $argsObject = null)
    {
        $object = new PathLockConnectionQueryObject("pathLocks");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPipeline(ProjectPipelineArgumentsObject $argsObject = null)
    {
        $object = new PipelineQueryObject("pipeline");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPipelineAnalytics(ProjectPipelineAnalyticsArgumentsObject $argsObject = null)
    {
        $object = new PipelineAnalyticsQueryObject("pipelineAnalytics");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPipelines(ProjectPipelinesArgumentsObject $argsObject = null)
    {
        $object = new PipelineConnectionQueryObject("pipelines");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPrintingMergeRequestLinkEnabled()
    {
        $this->selectField("printingMergeRequestLinkEnabled");

        return $this;
    }

    public function selectProjectMembers(ProjectProjectMembersArgumentsObject $argsObject = null)
    {
        $object = new MemberInterfaceConnectionQueryObject("projectMembers");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPublicJobs()
    {
        $this->selectField("publicJobs");

        return $this;
    }

    public function selectPushRules(ProjectPushRulesArgumentsObject $argsObject = null)
    {
        $object = new PushRulesQueryObject("pushRules");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRelease(ProjectReleaseArgumentsObject $argsObject = null)
    {
        $object = new ReleaseQueryObject("release");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectReleases(ProjectReleasesArgumentsObject $argsObject = null)
    {
        $object = new ReleaseConnectionQueryObject("releases");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRemoveSourceBranchAfterMerge()
    {
        $this->selectField("removeSourceBranchAfterMerge");

        return $this;
    }

    public function selectRepository(ProjectRepositoryArgumentsObject $argsObject = null)
    {
        $object = new RepositoryQueryObject("repository");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRepositorySizeExcess()
    {
        $this->selectField("repositorySizeExcess");

        return $this;
    }

    public function selectRequestAccessEnabled()
    {
        $this->selectField("requestAccessEnabled");

        return $this;
    }

    public function selectRequirement(ProjectRequirementArgumentsObject $argsObject = null)
    {
        $object = new RequirementQueryObject("requirement");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRequirementStatesCount(ProjectRequirementStatesCountArgumentsObject $argsObject = null)
    {
        $object = new RequirementStatesCountQueryObject("requirementStatesCount");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRequirements(ProjectRequirementsArgumentsObject $argsObject = null)
    {
        $object = new RequirementConnectionQueryObject("requirements");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSastCiConfiguration(ProjectSastCiConfigurationArgumentsObject $argsObject = null)
    {
        $object = new SastCiConfigurationQueryObject("sastCiConfiguration");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectScanExecutionPolicies(ProjectScanExecutionPoliciesArgumentsObject $argsObject = null)
    {
        $object = new ScanExecutionPolicyConnectionQueryObject("scanExecutionPolicies");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSecurityDashboardPath()
    {
        $this->selectField("securityDashboardPath");

        return $this;
    }

    public function selectSecurityScanners(ProjectSecurityScannersArgumentsObject $argsObject = null)
    {
        $object = new SecurityScannersQueryObject("securityScanners");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSentryDetailedError(ProjectSentryDetailedErrorArgumentsObject $argsObject = null)
    {
        $object = new SentryDetailedErrorQueryObject("sentryDetailedError");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSentryErrors(ProjectSentryErrorsArgumentsObject $argsObject = null)
    {
        $object = new SentryErrorCollectionQueryObject("sentryErrors");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectServiceDeskAddress()
    {
        $this->selectField("serviceDeskAddress");

        return $this;
    }

    public function selectServiceDeskEnabled()
    {
        $this->selectField("serviceDeskEnabled");

        return $this;
    }

    public function selectServices(ProjectServicesArgumentsObject $argsObject = null)
    {
        $object = new ServiceConnectionQueryObject("services");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSharedRunnersEnabled()
    {
        $this->selectField("sharedRunnersEnabled");

        return $this;
    }

    public function selectSnippets(ProjectSnippetsArgumentsObject $argsObject = null)
    {
        $object = new SnippetConnectionQueryObject("snippets");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSnippetsEnabled()
    {
        $this->selectField("snippetsEnabled");

        return $this;
    }

    public function selectSquashReadOnly()
    {
        $this->selectField("squashReadOnly");

        return $this;
    }

    public function selectSshUrlToRepo()
    {
        $this->selectField("sshUrlToRepo");

        return $this;
    }

    public function selectStarCount()
    {
        $this->selectField("starCount");

        return $this;
    }

    public function selectStatistics(ProjectStatisticsArgumentsObject $argsObject = null)
    {
        $object = new ProjectStatisticsQueryObject("statistics");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSuggestionCommitMessage()
    {
        $this->selectField("suggestionCommitMessage");

        return $this;
    }

    /**
     * @deprecated Use `topics`. Deprecated in 13.12.
     */
    public function selectTagList()
    {
        $this->selectField("tagList");

        return $this;
    }

    public function selectTerraformState(ProjectTerraformStateArgumentsObject $argsObject = null)
    {
        $object = new TerraformStateQueryObject("terraformState");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTerraformStates(ProjectTerraformStatesArgumentsObject $argsObject = null)
    {
        $object = new TerraformStateConnectionQueryObject("terraformStates");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTimelogs(ProjectTimelogsArgumentsObject $argsObject = null)
    {
        $object = new TimelogConnectionQueryObject("timelogs");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTopics()
    {
        $this->selectField("topics");

        return $this;
    }

    public function selectUserPermissions(ProjectUserPermissionsArgumentsObject $argsObject = null)
    {
        $object = new ProjectPermissionsQueryObject("userPermissions");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectVisibility()
    {
        $this->selectField("visibility");

        return $this;
    }

    public function selectVulnerabilities(ProjectVulnerabilitiesArgumentsObject $argsObject = null)
    {
        $object = new VulnerabilityConnectionQueryObject("vulnerabilities");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectVulnerabilitiesCountByDay(ProjectVulnerabilitiesCountByDayArgumentsObject $argsObject = null)
    {
        $object = new VulnerabilitiesCountByDayConnectionQueryObject("vulnerabilitiesCountByDay");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectVulnerabilityScanners(ProjectVulnerabilityScannersArgumentsObject $argsObject = null)
    {
        $object = new VulnerabilityScannerConnectionQueryObject("vulnerabilityScanners");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectVulnerabilitySeveritiesCount(ProjectVulnerabilitySeveritiesCountArgumentsObject $argsObject = null)
    {
        $object = new VulnerabilitySeveritiesCountQueryObject("vulnerabilitySeveritiesCount");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectWebUrl()
    {
        $this->selectField("webUrl");

        return $this;
    }

    public function selectWikiEnabled()
    {
        $this->selectField("wikiEnabled");

        return $this;
    }
}
