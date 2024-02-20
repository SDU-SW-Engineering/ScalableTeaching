<?php

namespace GraphQL\SchemaObject;

class GroupQueryObject extends QueryObject
{
    const OBJECT_NAME = "Group";

    /**
     * @deprecated **Status**: Experiment. Introduced in 15.8.
     */
    public function selectAchievements(GroupAchievementsArgumentsObject $argsObject = null)
    {
        $object = new AchievementConnectionQueryObject("achievements");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectAutoDevopsEnabled()
    {
        $this->selectField("autoDevopsEnabled");

        return $this;
    }

    public function selectAutocompleteUsers(GroupAutocompleteUsersArgumentsObject $argsObject = null)
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

    public function selectCiVariables(GroupCiVariablesArgumentsObject $argsObject = null)
    {
        $object = new CiGroupVariableConnectionQueryObject("ciVariables");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectContactStateCounts(GroupContactStateCountsArgumentsObject $argsObject = null)
    {
        $object = new ContactStateCountsQueryObject("contactStateCounts");
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

    public function selectCrossProjectPipelineAvailable()
    {
        $this->selectField("crossProjectPipelineAvailable");

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

    public function selectDataTransfer(GroupDataTransferArgumentsObject $argsObject = null)
    {
        $object = new GroupDataTransferQueryObject("dataTransfer");
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

    public function selectDependencyProxyTotalSizeBytes()
    {
        $this->selectField("dependencyProxyTotalSizeBytes");

        return $this;
    }

    /**
     * @deprecated Use `dependencyProxyTotalSizeBytes`. Deprecated in 16.1.
     */
    public function selectDependencyProxyTotalSizeInBytes()
    {
        $this->selectField("dependencyProxyTotalSizeInBytes");

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

    public function selectDescendantGroupsCount()
    {
        $this->selectField("descendantGroupsCount");

        return $this;
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

    public function selectEmailsDisabled()
    {
        $this->selectField("emailsDisabled");

        return $this;
    }

    public function selectEmailsEnabled()
    {
        $this->selectField("emailsEnabled");

        return $this;
    }

    public function selectEnvironmentScopes(GroupEnvironmentScopesArgumentsObject $argsObject = null)
    {
        $object = new CiGroupEnvironmentScopeConnectionQueryObject("environmentScopes");
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

    public function selectGroupMembersCount()
    {
        $this->selectField("groupMembersCount");

        return $this;
    }

    public function selectId()
    {
        $this->selectField("id");

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

    public function selectLockMathRenderingLimitsEnabled()
    {
        $this->selectField("lockMathRenderingLimitsEnabled");

        return $this;
    }

    public function selectMathRenderingLimitsEnabled()
    {
        $this->selectField("mathRenderingLimitsEnabled");

        return $this;
    }

    public function selectMaxAccessLevel(GroupMaxAccessLevelArgumentsObject $argsObject = null)
    {
        $object = new AccessLevelQueryObject("maxAccessLevel");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
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

    public function selectOrganizationStateCounts(GroupOrganizationStateCountsArgumentsObject $argsObject = null)
    {
        $object = new OrganizationStateCountsQueryObject("organizationStateCounts");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
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

    public function selectProjectsCount()
    {
        $this->selectField("projectsCount");

        return $this;
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

    public function selectReleases(GroupReleasesArgumentsObject $argsObject = null)
    {
        $object = new ReleaseConnectionQueryObject("releases");
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

    public function selectSubgroupCreationLevel()
    {
        $this->selectField("subgroupCreationLevel");

        return $this;
    }

    /**
     * @deprecated **Status**: Experiment. Introduced in 15.3.
     */
    public function selectTimelogCategories(GroupTimelogCategoriesArgumentsObject $argsObject = null)
    {
        $object = new TimeTrackingTimelogCategoryConnectionQueryObject("timelogCategories");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
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

    public function selectWebUrl()
    {
        $this->selectField("webUrl");

        return $this;
    }

    /**
     * @deprecated **Status**: Experiment. Introduced in 16.4.
     */
    public function selectWorkItem(GroupWorkItemArgumentsObject $argsObject = null)
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
    public function selectWorkItemStateCounts(GroupWorkItemStateCountsArgumentsObject $argsObject = null)
    {
        $object = new WorkItemStateCountsTypeQueryObject("workItemStateCounts");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectWorkItemTypes(GroupWorkItemTypesArgumentsObject $argsObject = null)
    {
        $object = new WorkItemTypeConnectionQueryObject("workItemTypes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    /**
     * @deprecated **Status**: Experiment. Introduced in 16.3.
     */
    public function selectWorkItems(GroupWorkItemsArgumentsObject $argsObject = null)
    {
        $object = new WorkItemConnectionQueryObject("workItems");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
