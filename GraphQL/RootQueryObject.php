<?php

namespace GraphQL\SchemaObject;

class RootQueryObject extends QueryObject
{
    const OBJECT_NAME = "";

    /**
     * @deprecated **Status**: Experiment. Introduced in 16.3.
     */
    public function selectAbuseReport(RootAbuseReportArgumentsObject $argsObject = null)
    {
        $object = new AbuseReportQueryObject("abuseReport");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    /**
     * @deprecated **Status**: Experiment. Introduced in 16.3.
     */
    public function selectAbuseReportLabels(RootAbuseReportLabelsArgumentsObject $argsObject = null)
    {
        $object = new LabelConnectionQueryObject("abuseReportLabels");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectAuditEventDefinitions(RootAuditEventDefinitionsArgumentsObject $argsObject = null)
    {
        $object = new AuditEventDefinitionConnectionQueryObject("auditEventDefinitions");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectBoardList(RootBoardListArgumentsObject $argsObject = null)
    {
        $object = new BoardListQueryObject("boardList");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCiApplicationSettings(RootCiApplicationSettingsArgumentsObject $argsObject = null)
    {
        $object = new CiApplicationSettingsQueryObject("ciApplicationSettings");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    /**
     * @deprecated **Status**: Experiment. Introduced in 16.1.
     */
    public function selectCiCatalogResource(RootCiCatalogResourceArgumentsObject $argsObject = null)
    {
        $object = new CiCatalogResourceQueryObject("ciCatalogResource");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    /**
     * @deprecated **Status**: Experiment. Introduced in 15.11.
     */
    public function selectCiCatalogResources(RootCiCatalogResourcesArgumentsObject $argsObject = null)
    {
        $object = new CiCatalogResourceConnectionQueryObject("ciCatalogResources");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCiConfig(RootCiConfigArgumentsObject $argsObject = null)
    {
        $object = new CiConfigQueryObject("ciConfig");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCiPipelineStage(RootCiPipelineStageArgumentsObject $argsObject = null)
    {
        $object = new CiStageQueryObject("ciPipelineStage");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCiVariables(RootCiVariablesArgumentsObject $argsObject = null)
    {
        $object = new CiInstanceVariableConnectionQueryObject("ciVariables");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectContainerRepository(RootContainerRepositoryArgumentsObject $argsObject = null)
    {
        $object = new ContainerRepositoryDetailsQueryObject("containerRepository");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCurrentUser(RootCurrentUserArgumentsObject $argsObject = null)
    {
        $object = new CurrentUserQueryObject("currentUser");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectDesignManagement(RootDesignManagementArgumentsObject $argsObject = null)
    {
        $object = new DesignManagementQueryObject("designManagement");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectEcho()
    {
        $this->selectField("echo");

        return $this;
    }

    public function selectFrecentGroups(RootFrecentGroupsArgumentsObject $argsObject = null)
    {
        $object = new GroupQueryObject("frecentGroups");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectFrecentProjects(RootFrecentProjectsArgumentsObject $argsObject = null)
    {
        $object = new ProjectQueryObject("frecentProjects");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectGitpodEnabled()
    {
        $this->selectField("gitpodEnabled");

        return $this;
    }

    public function selectGroup(RootGroupArgumentsObject $argsObject = null)
    {
        $object = new GroupQueryObject("group");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectGroups(RootGroupsArgumentsObject $argsObject = null)
    {
        $object = new GroupConnectionQueryObject("groups");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectIssue(RootIssueArgumentsObject $argsObject = null)
    {
        $object = new IssueQueryObject("issue");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    /**
     * @deprecated **Status**: Experiment. Introduced in 15.6.
     */
    public function selectIssues(RootIssuesArgumentsObject $argsObject = null)
    {
        $object = new IssueConnectionQueryObject("issues");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectJobs(RootJobsArgumentsObject $argsObject = null)
    {
        $object = new CiJobConnectionQueryObject("jobs");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectMergeRequest(RootMergeRequestArgumentsObject $argsObject = null)
    {
        $object = new MergeRequestQueryObject("mergeRequest");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectMetadata(RootMetadataArgumentsObject $argsObject = null)
    {
        $object = new MetadataQueryObject("metadata");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectMilestone(RootMilestoneArgumentsObject $argsObject = null)
    {
        $object = new MilestoneQueryObject("milestone");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    /**
     * @deprecated **Status**: Experiment. Introduced in 16.7.
     */
    public function selectMlModel(RootMlModelArgumentsObject $argsObject = null)
    {
        $object = new MlModelQueryObject("mlModel");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNamespace(RootNamespaceArgumentsObject $argsObject = null)
    {
        $object = new NamespaceQueryObject("namespace");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    /**
     * @deprecated **Status**: Experiment. Introduced in 15.9.
     */
    public function selectNote(RootNoteArgumentsObject $argsObject = null)
    {
        $object = new NoteQueryObject("note");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    /**
     * @deprecated **Status**: Experiment. Introduced in 16.4.
     */
    public function selectOrganization(RootOrganizationArgumentsObject $argsObject = null)
    {
        $object = new OrganizationQueryObject("organization");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    /**
     * @deprecated **Status**: Experiment. Introduced in 16.8.
     */
    public function selectOrganizations(RootOrganizationsArgumentsObject $argsObject = null)
    {
        $object = new OrganizationConnectionQueryObject("organizations");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPackage(RootPackageArgumentsObject $argsObject = null)
    {
        $object = new PackageDetailsTypeQueryObject("package");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectProject(RootProjectArgumentsObject $argsObject = null)
    {
        $object = new ProjectQueryObject("project");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectProjects(RootProjectsArgumentsObject $argsObject = null)
    {
        $object = new ProjectConnectionQueryObject("projects");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectQueryComplexity(RootQueryComplexityArgumentsObject $argsObject = null)
    {
        $object = new QueryComplexityQueryObject("queryComplexity");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRunner(RootRunnerArgumentsObject $argsObject = null)
    {
        $object = new CiRunnerQueryObject("runner");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    /**
     * @deprecated No longer used, use gitlab-runner documentation to learn about supported platforms. Deprecated in 15.9.
     */
    public function selectRunnerPlatforms(RootRunnerPlatformsArgumentsObject $argsObject = null)
    {
        $object = new RunnerPlatformConnectionQueryObject("runnerPlatforms");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    /**
     * @deprecated No longer used, use gitlab-runner documentation to learn about runner registration commands. Deprecated in 15.9.
     */
    public function selectRunnerSetup(RootRunnerSetupArgumentsObject $argsObject = null)
    {
        $object = new RunnerSetupQueryObject("runnerSetup");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRunners(RootRunnersArgumentsObject $argsObject = null)
    {
        $object = new CiRunnerConnectionQueryObject("runners");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSnippets(RootSnippetsArgumentsObject $argsObject = null)
    {
        $object = new SnippetConnectionQueryObject("snippets");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    /**
     * @deprecated **Status**: Experiment. Introduced in 15.9.
     */
    public function selectSyntheticNote(RootSyntheticNoteArgumentsObject $argsObject = null)
    {
        $object = new NoteQueryObject("syntheticNote");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTimelogs(RootTimelogsArgumentsObject $argsObject = null)
    {
        $object = new TimelogConnectionQueryObject("timelogs");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTodo(RootTodoArgumentsObject $argsObject = null)
    {
        $object = new TodoQueryObject("todo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTopics(RootTopicsArgumentsObject $argsObject = null)
    {
        $object = new TopicConnectionQueryObject("topics");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectUsageTrendsMeasurements(RootUsageTrendsMeasurementsArgumentsObject $argsObject = null)
    {
        $object = new UsageTrendsMeasurementConnectionQueryObject("usageTrendsMeasurements");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectUser(RootUserArgumentsObject $argsObject = null)
    {
        $object = new UserCoreQueryObject("user");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectUsers(RootUsersArgumentsObject $argsObject = null)
    {
        $object = new UserCoreConnectionQueryObject("users");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    /**
     * @deprecated **Status**: Experiment. Introduced in 15.1.
     */
    public function selectWorkItem(RootWorkItemArgumentsObject $argsObject = null)
    {
        $object = new WorkItemQueryObject("workItem");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    /**
     * @deprecated **Status**: Experiment. Introduced in 16.7.
     */
    public function selectWorkItemsByReference(RootWorkItemsByReferenceArgumentsObject $argsObject = null)
    {
        $object = new WorkItemConnectionQueryObject("workItemsByReference");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
