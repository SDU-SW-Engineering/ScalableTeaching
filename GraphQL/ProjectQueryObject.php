<?php

namespace GraphQL\SchemaObject;

class ProjectQueryObject extends QueryObject
{
    const OBJECT_NAME = "Project";

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

    public function selectAllowMergeOnSkippedPipeline()
    {
        $this->selectField("allowMergeOnSkippedPipeline");

        return $this;
    }

    public function selectAllowsMultipleMergeRequestAssignees()
    {
        $this->selectField("allowsMultipleMergeRequestAssignees");

        return $this;
    }

    public function selectAllowsMultipleMergeRequestReviewers()
    {
        $this->selectField("allowsMultipleMergeRequestReviewers");

        return $this;
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

    public function selectAutocompleteUsers(ProjectAutocompleteUsersArgumentsObject $argsObject = null)
    {
        $object = new AutocompletedUserQueryObject("autocompleteUsers");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
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

    public function selectBranchRules(ProjectBranchRulesArgumentsObject $argsObject = null)
    {
        $object = new BranchRuleConnectionQueryObject("branchRules");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCiAccessAuthorizedAgents(ProjectCiAccessAuthorizedAgentsArgumentsObject $argsObject = null)
    {
        $object = new ClusterAgentAuthorizationCiAccessConnectionQueryObject("ciAccessAuthorizedAgents");
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

    public function selectCiConfigPathOrDefault()
    {
        $this->selectField("ciConfigPathOrDefault");

        return $this;
    }

    /**
     * @deprecated **Status**: Experiment. Introduced in 15.3.
     */
    public function selectCiConfigVariables(ProjectCiConfigVariablesArgumentsObject $argsObject = null)
    {
        $object = new CiConfigVariableQueryObject("ciConfigVariables");
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

    public function selectCiVariables(ProjectCiVariablesArgumentsObject $argsObject = null)
    {
        $object = new CiProjectVariableConnectionQueryObject("ciVariables");
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

    /**
     * @deprecated **Status**: Experiment. Introduced in 16.0.
     */
    public function selectCommitReferences(ProjectCommitReferencesArgumentsObject $argsObject = null)
    {
        $object = new CommitReferencesQueryObject("commitReferences");
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

    public function selectDataTransfer(ProjectDataTransferArgumentsObject $argsObject = null)
    {
        $object = new ProjectDataTransferQueryObject("dataTransfer");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectDeployment(ProjectDeploymentArgumentsObject $argsObject = null)
    {
        $object = new DeploymentQueryObject("deployment");
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

    public function selectDetailedImportStatus(ProjectDetailedImportStatusArgumentsObject $argsObject = null)
    {
        $object = new DetailedImportStatusQueryObject("detailedImportStatus");
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

    /**
     * @deprecated **Status**: Experiment. Introduced in 15.10.
     */
    public function selectFlowMetrics(ProjectFlowMetricsArgumentsObject $argsObject = null)
    {
        $object = new ProjectValueStreamAnalyticsFlowMetricsQueryObject("flowMetrics");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    /**
     * @deprecated **Status**: Experiment. Introduced in 15.7.
     */
    public function selectForkDetails(ProjectForkDetailsArgumentsObject $argsObject = null)
    {
        $object = new ForkDetailsQueryObject("forkDetails");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectForkTargets(ProjectForkTargetsArgumentsObject $argsObject = null)
    {
        $object = new NamespaceConnectionQueryObject("forkTargets");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectForkingAccessLevel(ProjectForkingAccessLevelArgumentsObject $argsObject = null)
    {
        $object = new ProjectFeatureAccessQueryObject("forkingAccessLevel");
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

    public function selectIncidentManagementTimelineEvent(ProjectIncidentManagementTimelineEventArgumentsObject $argsObject = null)
    {
        $object = new TimelineEventTypeQueryObject("incidentManagementTimelineEvent");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectIncidentManagementTimelineEventTags(ProjectIncidentManagementTimelineEventTagsArgumentsObject $argsObject = null)
    {
        $object = new TimelineEventTagTypeQueryObject("incidentManagementTimelineEventTags");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectIncidentManagementTimelineEvents(ProjectIncidentManagementTimelineEventsArgumentsObject $argsObject = null)
    {
        $object = new TimelineEventTypeConnectionQueryObject("incidentManagementTimelineEvents");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectInheritedCiVariables(ProjectInheritedCiVariablesArgumentsObject $argsObject = null)
    {
        $object = new InheritedCiVariableConnectionQueryObject("inheritedCiVariables");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    /**
     * @deprecated **Status**: Experiment. Introduced in 15.11.
     */
    public function selectIsCatalogResource()
    {
        $this->selectField("isCatalogResource");

        return $this;
    }

    public function selectIsForked()
    {
        $this->selectField("isForked");

        return $this;
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

    public function selectIssuesAccessLevel(ProjectIssuesAccessLevelArgumentsObject $argsObject = null)
    {
        $object = new ProjectFeatureAccessQueryObject("issuesAccessLevel");
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

    public function selectJob(ProjectJobArgumentsObject $argsObject = null)
    {
        $object = new CiJobQueryObject("job");
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

    public function selectLanguages(ProjectLanguagesArgumentsObject $argsObject = null)
    {
        $object = new RepositoryLanguageQueryObject("languages");
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

    public function selectMaxAccessLevel(ProjectMaxAccessLevelArgumentsObject $argsObject = null)
    {
        $object = new AccessLevelQueryObject("maxAccessLevel");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectMergeCommitTemplate()
    {
        $this->selectField("mergeCommitTemplate");

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

    public function selectMergeRequestsAccessLevel(ProjectMergeRequestsAccessLevelArgumentsObject $argsObject = null)
    {
        $object = new ProjectFeatureAccessQueryObject("mergeRequestsAccessLevel");
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

    /**
     * @deprecated **Status**: Experiment. Introduced in 16.8.
     */
    public function selectMlModels(ProjectMlModelsArgumentsObject $argsObject = null)
    {
        $object = new MlModelConnectionQueryObject("mlModels");
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

    public function selectNestedEnvironments(ProjectNestedEnvironmentsArgumentsObject $argsObject = null)
    {
        $object = new NestedEnvironmentConnectionQueryObject("nestedEnvironments");
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

    public function selectOpenMergeRequestsCount()
    {
        $this->selectField("openMergeRequestsCount");

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

    public function selectPackagesCleanupPolicy(ProjectPackagesCleanupPolicyArgumentsObject $argsObject = null)
    {
        $object = new PackagesCleanupPolicyQueryObject("packagesCleanupPolicy");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPackagesProtectionRules(ProjectPackagesProtectionRulesArgumentsObject $argsObject = null)
    {
        $object = new PackagesProtectionRuleConnectionQueryObject("packagesProtectionRules");
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

    public function selectPipelineCounts(ProjectPipelineCountsArgumentsObject $argsObject = null)
    {
        $object = new PipelineCountsQueryObject("pipelineCounts");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPipelineSchedules(ProjectPipelineSchedulesArgumentsObject $argsObject = null)
    {
        $object = new PipelineScheduleConnectionQueryObject("pipelineSchedules");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    /**
     * @deprecated **Status**: Experiment. Introduced in 16.3.
     */
    public function selectPipelineTriggers(ProjectPipelineTriggersArgumentsObject $argsObject = null)
    {
        $object = new PipelineTriggerConnectionQueryObject("pipelineTriggers");
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

    /**
     * @deprecated **Status**: Experiment. Introduced in 16.9.
     */
    public function selectProjectPlanLimits(ProjectProjectPlanLimitsArgumentsObject $argsObject = null)
    {
        $object = new ProjectPlanLimitsQueryObject("projectPlanLimits");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    /**
     * @deprecated **Status**: Experiment. Introduced in 16.9.
     */
    public function selectProtectableBranches()
    {
        $this->selectField("protectableBranches");

        return $this;
    }

    public function selectPublicJobs()
    {
        $this->selectField("publicJobs");

        return $this;
    }

    public function selectRecentIssueBoards(ProjectRecentIssueBoardsArgumentsObject $argsObject = null)
    {
        $object = new BoardConnectionQueryObject("recentIssueBoards");
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

    public function selectRequestAccessEnabled()
    {
        $this->selectField("requestAccessEnabled");

        return $this;
    }

    public function selectRunners(ProjectRunnersArgumentsObject $argsObject = null)
    {
        $object = new CiRunnerConnectionQueryObject("runners");
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

    /**
     * @deprecated This will be renamed to `Project.integrations`. Deprecated in 15.9.
     */
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

    public function selectSquashCommitTemplate()
    {
        $this->selectField("squashCommitTemplate");

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

    public function selectStatisticsDetailsPaths(ProjectStatisticsDetailsPathsArgumentsObject $argsObject = null)
    {
        $object = new ProjectStatisticsRedirectQueryObject("statisticsDetailsPaths");
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

    /**
     * @deprecated **Status**: Experiment. Introduced in 15.3.
     */
    public function selectTimelogCategories(ProjectTimelogCategoriesArgumentsObject $argsObject = null)
    {
        $object = new TimeTrackingTimelogCategoryConnectionQueryObject("timelogCategories");
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

    public function selectUserAccessAuthorizedAgents(ProjectUserAccessAuthorizedAgentsArgumentsObject $argsObject = null)
    {
        $object = new ClusterAgentAuthorizationUserAccessConnectionQueryObject("userAccessAuthorizedAgents");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
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

    public function selectValueStreams(ProjectValueStreamsArgumentsObject $argsObject = null)
    {
        $object = new ValueStreamConnectionQueryObject("valueStreams");
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

    /**
     * @deprecated **Status**: Experiment. Introduced in 15.10.
     */
    public function selectVisibleForks(ProjectVisibleForksArgumentsObject $argsObject = null)
    {
        $object = new ProjectConnectionQueryObject("visibleForks");
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

    /**
     * @deprecated **Status**: Experiment. Introduced in 16.7.
     */
    public function selectWorkItemStateCounts(ProjectWorkItemStateCountsArgumentsObject $argsObject = null)
    {
        $object = new WorkItemStateCountsTypeQueryObject("workItemStateCounts");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectWorkItemTypes(ProjectWorkItemTypesArgumentsObject $argsObject = null)
    {
        $object = new WorkItemTypeConnectionQueryObject("workItemTypes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    /**
     * @deprecated **Status**: Experiment. Introduced in 15.1.
     */
    public function selectWorkItems(ProjectWorkItemsArgumentsObject $argsObject = null)
    {
        $object = new WorkItemConnectionQueryObject("workItems");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
