<?php

namespace GraphQL\SchemaObject;

class UserCoreQueryObject extends QueryObject
{
    const OBJECT_NAME = "UserCore";

    public function selectAssignedMergeRequests(UserCoreAssignedMergeRequestsArgumentsObject $argsObject = null)
    {
        $object = new MergeRequestConnectionQueryObject("assignedMergeRequests");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectAuthoredMergeRequests(UserCoreAuthoredMergeRequestsArgumentsObject $argsObject = null)
    {
        $object = new MergeRequestConnectionQueryObject("authoredMergeRequests");
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

    public function selectBio()
    {
        $this->selectField("bio");

        return $this;
    }

    public function selectBot()
    {
        $this->selectField("bot");

        return $this;
    }

    public function selectCallouts(UserCoreCalloutsArgumentsObject $argsObject = null)
    {
        $object = new UserCalloutConnectionQueryObject("callouts");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCommitEmail()
    {
        $this->selectField("commitEmail");

        return $this;
    }

    public function selectCreatedAt()
    {
        $this->selectField("createdAt");

        return $this;
    }

    public function selectDiscord()
    {
        $this->selectField("discord");

        return $this;
    }

    /**
     * @deprecated This was renamed. Please use `User.publicEmail`. Deprecated in 13.7.
     */
    public function selectEmail()
    {
        $this->selectField("email");

        return $this;
    }

    public function selectEmails(UserCoreEmailsArgumentsObject $argsObject = null)
    {
        $object = new EmailConnectionQueryObject("emails");
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

    public function selectGroupCount()
    {
        $this->selectField("groupCount");

        return $this;
    }

    public function selectGroupMemberships(UserCoreGroupMembershipsArgumentsObject $argsObject = null)
    {
        $object = new GroupMemberConnectionQueryObject("groupMemberships");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectGroups(UserCoreGroupsArgumentsObject $argsObject = null)
    {
        $object = new GroupConnectionQueryObject("groups");
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

    public function selectIde(UserCoreIdeArgumentsObject $argsObject = null)
    {
        $object = new IdeQueryObject("ide");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectJobTitle()
    {
        $this->selectField("jobTitle");

        return $this;
    }

    public function selectLastActivityOn()
    {
        $this->selectField("lastActivityOn");

        return $this;
    }

    public function selectLinkedin()
    {
        $this->selectField("linkedin");

        return $this;
    }

    public function selectLocation()
    {
        $this->selectField("location");

        return $this;
    }

    public function selectName()
    {
        $this->selectField("name");

        return $this;
    }

    public function selectNamespace(UserCoreNamespaceArgumentsObject $argsObject = null)
    {
        $object = new NamespaceQueryObject("namespace");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNamespaceCommitEmails(UserCoreNamespaceCommitEmailsArgumentsObject $argsObject = null)
    {
        $object = new NamespaceCommitEmailConnectionQueryObject("namespaceCommitEmails");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectOrganization()
    {
        $this->selectField("organization");

        return $this;
    }

    /**
     * @deprecated **Status**: Experiment. Introduced in 16.6.
     */
    public function selectOrganizations(UserCoreOrganizationsArgumentsObject $argsObject = null)
    {
        $object = new OrganizationConnectionQueryObject("organizations");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPreferencesGitpodPath()
    {
        $this->selectField("preferencesGitpodPath");

        return $this;
    }

    public function selectProfileEnableGitpodPath()
    {
        $this->selectField("profileEnableGitpodPath");

        return $this;
    }

    public function selectProjectMemberships(UserCoreProjectMembershipsArgumentsObject $argsObject = null)
    {
        $object = new ProjectMemberConnectionQueryObject("projectMemberships");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPronouns()
    {
        $this->selectField("pronouns");

        return $this;
    }

    public function selectPublicEmail()
    {
        $this->selectField("publicEmail");

        return $this;
    }

    public function selectReviewRequestedMergeRequests(UserCoreReviewRequestedMergeRequestsArgumentsObject $argsObject = null)
    {
        $object = new MergeRequestConnectionQueryObject("reviewRequestedMergeRequests");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSavedReplies(UserCoreSavedRepliesArgumentsObject $argsObject = null)
    {
        $object = new SavedReplyConnectionQueryObject("savedReplies");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSavedReply(UserCoreSavedReplyArgumentsObject $argsObject = null)
    {
        $object = new SavedReplyQueryObject("savedReply");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSnippets(UserCoreSnippetsArgumentsObject $argsObject = null)
    {
        $object = new SnippetConnectionQueryObject("snippets");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectStarredProjects(UserCoreStarredProjectsArgumentsObject $argsObject = null)
    {
        $object = new ProjectConnectionQueryObject("starredProjects");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectState()
    {
        $this->selectField("state");

        return $this;
    }

    public function selectStatus(UserCoreStatusArgumentsObject $argsObject = null)
    {
        $object = new UserStatusQueryObject("status");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTimelogs(UserCoreTimelogsArgumentsObject $argsObject = null)
    {
        $object = new TimelogConnectionQueryObject("timelogs");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTodos(UserCoreTodosArgumentsObject $argsObject = null)
    {
        $object = new TodoConnectionQueryObject("todos");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTwitter()
    {
        $this->selectField("twitter");

        return $this;
    }

    /**
     * @deprecated **Status**: Experiment. Introduced in 15.10.
     */
    public function selectUserAchievements(UserCoreUserAchievementsArgumentsObject $argsObject = null)
    {
        $object = new UserAchievementConnectionQueryObject("userAchievements");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectUserPermissions(UserCoreUserPermissionsArgumentsObject $argsObject = null)
    {
        $object = new UserPermissionsQueryObject("userPermissions");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectUsername()
    {
        $this->selectField("username");

        return $this;
    }

    public function selectWebPath()
    {
        $this->selectField("webPath");

        return $this;
    }

    public function selectWebUrl()
    {
        $this->selectField("webUrl");

        return $this;
    }
}
