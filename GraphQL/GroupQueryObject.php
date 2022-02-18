<?php

namespace GraphQL\SchemaObject;

class GroupQueryObject extends QueryObject
{
    const OBJECT_NAME = "Group";

    public function selectActualRepositorySizeLimit()
    {
        $this->selectField("actualRepositorySizeLimit");

        return $this;
    }

    public function selectAdditionalPurchasedStorageSize()
    {
        $this->selectField("additionalPurchasedStorageSize");

        return $this;
    }

    public function selectAutoDevopsEnabled()
    {
        $this->selectField("autoDevopsEnabled");

        return $this;
    }

    public function selectAvatarUrl()
    {
        $this->selectField("avatarUrl");

        return $this;
    }

    public function selectBillableMembersCount()
    {
        $this->selectField("billableMembersCount");

        return $this;
    }

    public function selectBoard(GroupBoardArgumentsObject $argsObject = null)
    {
        $object = new BoardQueryObject("board");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectBoards(GroupBoardsArgumentsObject $argsObject = null)
    {
        $object = new BoardConnectionQueryObject("boards");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCodeCoverageActivities(GroupCodeCoverageActivitiesArgumentsObject $argsObject = null)
    {
        $object = new CodeCoverageActivityConnectionQueryObject("codeCoverageActivities");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectComplianceFrameworks(GroupComplianceFrameworksArgumentsObject $argsObject = null)
    {
        $object = new ComplianceFrameworkConnectionQueryObject("complianceFrameworks");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectContacts(GroupContactsArgumentsObject $argsObject = null)
    {
        $object = new CustomerRelationsContactConnectionQueryObject("contacts");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectContainerRepositories(GroupContainerRepositoriesArgumentsObject $argsObject = null)
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

    public function selectContainsLockedProjects()
    {
        $this->selectField("containsLockedProjects");

        return $this;
    }

    public function selectCustomEmoji(GroupCustomEmojiArgumentsObject $argsObject = null)
    {
        $object = new CustomEmojiConnectionQueryObject("customEmoji");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectDependencyProxyBlobCount()
    {
        $this->selectField("dependencyProxyBlobCount");

        return $this;
    }

    public function selectDependencyProxyBlobs(GroupDependencyProxyBlobsArgumentsObject $argsObject = null)
    {
        $object = new DependencyProxyBlobConnectionQueryObject("dependencyProxyBlobs");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectDependencyProxyImageCount()
    {
        $this->selectField("dependencyProxyImageCount");

        return $this;
    }

    public function selectDependencyProxyImagePrefix()
    {
        $this->selectField("dependencyProxyImagePrefix");

        return $this;
    }

    public function selectDependencyProxyImageTtlPolicy(GroupDependencyProxyImageTtlPolicyArgumentsObject $argsObject = null)
    {
        $object = new DependencyProxyImageTtlGroupPolicyQueryObject("dependencyProxyImageTtlPolicy");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectDependencyProxyManifests(GroupDependencyProxyManifestsArgumentsObject $argsObject = null)
    {
        $object = new DependencyProxyManifestConnectionQueryObject("dependencyProxyManifests");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectDependencyProxySetting(GroupDependencyProxySettingArgumentsObject $argsObject = null)
    {
        $object = new DependencyProxySettingQueryObject("dependencyProxySetting");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectDependencyProxyTotalSize()
    {
        $this->selectField("dependencyProxyTotalSize");

        return $this;
    }

    public function selectDescendantGroups(GroupDescendantGroupsArgumentsObject $argsObject = null)
    {
        $object = new GroupConnectionQueryObject("descendantGroups");
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

    public function selectDora(GroupDoraArgumentsObject $argsObject = null)
    {
        $object = new DoraQueryObject("dora");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectEmailsDisabled()
    {
        $this->selectField("emailsDisabled");

        return $this;
    }

    public function selectEpic(GroupEpicArgumentsObject $argsObject = null)
    {
        $object = new EpicQueryObject("epic");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectEpicBoard(GroupEpicBoardArgumentsObject $argsObject = null)
    {
        $object = new EpicBoardQueryObject("epicBoard");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectEpicBoards(GroupEpicBoardsArgumentsObject $argsObject = null)
    {
        $object = new EpicBoardConnectionQueryObject("epicBoards");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectEpics(GroupEpicsArgumentsObject $argsObject = null)
    {
        $object = new EpicConnectionQueryObject("epics");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectEpicsEnabled()
    {
        $this->selectField("epicsEnabled");

        return $this;
    }

    public function selectExternalAuditEventDestinations(GroupExternalAuditEventDestinationsArgumentsObject $argsObject = null)
    {
        $object = new ExternalAuditEventDestinationConnectionQueryObject("externalAuditEventDestinations");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectFullName()
    {
        $this->selectField("fullName");

        return $this;
    }

    public function selectFullPath()
    {
        $this->selectField("fullPath");

        return $this;
    }

    public function selectGroupMembers(GroupGroupMembersArgumentsObject $argsObject = null)
    {
        $object = new GroupMemberConnectionQueryObject("groupMembers");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectIsTemporaryStorageIncreaseEnabled()
    {
        $this->selectField("isTemporaryStorageIncreaseEnabled");

        return $this;
    }

    public function selectIssues(GroupIssuesArgumentsObject $argsObject = null)
    {
        $object = new IssueConnectionQueryObject("issues");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectIterationCadences(GroupIterationCadencesArgumentsObject $argsObject = null)
    {
        $object = new IterationCadenceConnectionQueryObject("iterationCadences");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectIterations(GroupIterationsArgumentsObject $argsObject = null)
    {
        $object = new IterationConnectionQueryObject("iterations");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectLabel(GroupLabelArgumentsObject $argsObject = null)
    {
        $object = new LabelQueryObject("label");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectLabels(GroupLabelsArgumentsObject $argsObject = null)
    {
        $object = new LabelConnectionQueryObject("labels");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectLfsEnabled()
    {
        $this->selectField("lfsEnabled");

        return $this;
    }

    public function selectMentionsDisabled()
    {
        $this->selectField("mentionsDisabled");

        return $this;
    }

    public function selectMergeRequests(GroupMergeRequestsArgumentsObject $argsObject = null)
    {
        $object = new MergeRequestConnectionQueryObject("mergeRequests");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectMilestones(GroupMilestonesArgumentsObject $argsObject = null)
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

    public function selectOrganizations(GroupOrganizationsArgumentsObject $argsObject = null)
    {
        $object = new CustomerRelationsOrganizationConnectionQueryObject("organizations");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPackageSettings(GroupPackageSettingsArgumentsObject $argsObject = null)
    {
        $object = new PackageSettingsQueryObject("packageSettings");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPackages(GroupPackagesArgumentsObject $argsObject = null)
    {
        $object = new PackageConnectionQueryObject("packages");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectParent(GroupParentArgumentsObject $argsObject = null)
    {
        $object = new GroupQueryObject("parent");
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

    public function selectProjectCreationLevel()
    {
        $this->selectField("projectCreationLevel");

        return $this;
    }

    public function selectProjects(GroupProjectsArgumentsObject $argsObject = null)
    {
        $object = new ProjectConnectionQueryObject("projects");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRecentIssueBoards(GroupRecentIssueBoardsArgumentsObject $argsObject = null)
    {
        $object = new BoardConnectionQueryObject("recentIssueBoards");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRepositorySizeExcessProjectCount()
    {
        $this->selectField("repositorySizeExcessProjectCount");

        return $this;
    }

    public function selectRequestAccessEnabled()
    {
        $this->selectField("requestAccessEnabled");

        return $this;
    }

    public function selectRequireTwoFactorAuthentication()
    {
        $this->selectField("requireTwoFactorAuthentication");

        return $this;
    }

    public function selectRootStorageStatistics(GroupRootStorageStatisticsArgumentsObject $argsObject = null)
    {
        $object = new RootStorageStatisticsQueryObject("rootStorageStatistics");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRunners(GroupRunnersArgumentsObject $argsObject = null)
    {
        $object = new CiRunnerConnectionQueryObject("runners");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectShareWithGroupLock()
    {
        $this->selectField("shareWithGroupLock");

        return $this;
    }

    public function selectSharedRunnersSetting()
    {
        $this->selectField("sharedRunnersSetting");

        return $this;
    }

    public function selectStats(GroupStatsArgumentsObject $argsObject = null)
    {
        $object = new GroupStatsQueryObject("stats");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectStorageSizeLimit()
    {
        $this->selectField("storageSizeLimit");

        return $this;
    }

    public function selectSubgroupCreationLevel()
    {
        $this->selectField("subgroupCreationLevel");

        return $this;
    }

    public function selectTemporaryStorageIncreaseEndsOn()
    {
        $this->selectField("temporaryStorageIncreaseEndsOn");

        return $this;
    }

    public function selectTimelogs(GroupTimelogsArgumentsObject $argsObject = null)
    {
        $object = new TimelogConnectionQueryObject("timelogs");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTotalRepositorySize()
    {
        $this->selectField("totalRepositorySize");

        return $this;
    }

    public function selectTotalRepositorySizeExcess()
    {
        $this->selectField("totalRepositorySizeExcess");

        return $this;
    }

    public function selectTwoFactorGracePeriod()
    {
        $this->selectField("twoFactorGracePeriod");

        return $this;
    }

    public function selectUserPermissions(GroupUserPermissionsArgumentsObject $argsObject = null)
    {
        $object = new GroupPermissionsQueryObject("userPermissions");
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

    public function selectVulnerabilities(GroupVulnerabilitiesArgumentsObject $argsObject = null)
    {
        $object = new VulnerabilityConnectionQueryObject("vulnerabilities");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectVulnerabilitiesCountByDay(GroupVulnerabilitiesCountByDayArgumentsObject $argsObject = null)
    {
        $object = new VulnerabilitiesCountByDayConnectionQueryObject("vulnerabilitiesCountByDay");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectVulnerabilityGrades(GroupVulnerabilityGradesArgumentsObject $argsObject = null)
    {
        $object = new VulnerableProjectsByGradeQueryObject("vulnerabilityGrades");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectVulnerabilityScanners(GroupVulnerabilityScannersArgumentsObject $argsObject = null)
    {
        $object = new VulnerabilityScannerConnectionQueryObject("vulnerabilityScanners");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectVulnerabilitySeveritiesCount(GroupVulnerabilitySeveritiesCountArgumentsObject $argsObject = null)
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
}
