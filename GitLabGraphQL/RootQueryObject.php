<?php

namespace GraphQL\SchemaObject;

class RootQueryObject extends QueryObject
{
    const OBJECT_NAME = "";

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

    public function selectCiConfig(RootCiConfigArgumentsObject $argsObject = null)
    {
        $object = new CiConfigQueryObject("ciConfig");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCiMinutesUsage(RootCiMinutesUsageArgumentsObject $argsObject = null)
    {
        $object = new CiMinutesNamespaceMonthlyUsageConnectionQueryObject("ciMinutesUsage");
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

    public function selectCurrentLicense(RootCurrentLicenseArgumentsObject $argsObject = null)
    {
        $object = new CurrentLicenseQueryObject("currentLicense");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCurrentUser(RootCurrentUserArgumentsObject $argsObject = null)
    {
        $object = new UserCoreQueryObject("currentUser");
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

    public function selectDevopsAdoptionEnabledNamespaces(RootDevopsAdoptionEnabledNamespacesArgumentsObject $argsObject = null)
    {
        $object = new DevopsAdoptionEnabledNamespaceConnectionQueryObject("devopsAdoptionEnabledNamespaces");
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

    public function selectGeoNode(RootGeoNodeArgumentsObject $argsObject = null)
    {
        $object = new GeoNodeQueryObject("geoNode");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
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

    public function selectInstanceSecurityDashboard(RootInstanceSecurityDashboardArgumentsObject $argsObject = null)
    {
        $object = new InstanceSecurityDashboardQueryObject("instanceSecurityDashboard");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    /**
     * @deprecated This was renamed. Please use `Query.usageTrendsMeasurements`. Deprecated in 13.10.
     */
    public function selectInstanceStatisticsMeasurements(RootInstanceStatisticsMeasurementsArgumentsObject $argsObject = null)
    {
        $object = new UsageTrendsMeasurementConnectionQueryObject("instanceStatisticsMeasurements");
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

    public function selectIteration(RootIterationArgumentsObject $argsObject = null)
    {
        $object = new IterationQueryObject("iteration");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectLicenseHistoryEntries(RootLicenseHistoryEntriesArgumentsObject $argsObject = null)
    {
        $object = new LicenseHistoryEntryConnectionQueryObject("licenseHistoryEntries");
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

    public function selectNamespace(RootNamespaceArgumentsObject $argsObject = null)
    {
        $object = new NamespaceQueryObject("namespace");
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

    public function selectRunnerPlatforms(RootRunnerPlatformsArgumentsObject $argsObject = null)
    {
        $object = new RunnerPlatformConnectionQueryObject("runnerPlatforms");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

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

    public function selectTimelogs(RootTimelogsArgumentsObject $argsObject = null)
    {
        $object = new TimelogConnectionQueryObject("timelogs");
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

    public function selectVulnerabilities(RootVulnerabilitiesArgumentsObject $argsObject = null)
    {
        $object = new VulnerabilityConnectionQueryObject("vulnerabilities");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectVulnerabilitiesCountByDay(RootVulnerabilitiesCountByDayArgumentsObject $argsObject = null)
    {
        $object = new VulnerabilitiesCountByDayConnectionQueryObject("vulnerabilitiesCountByDay");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectVulnerability(RootVulnerabilityArgumentsObject $argsObject = null)
    {
        $object = new VulnerabilityQueryObject("vulnerability");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
