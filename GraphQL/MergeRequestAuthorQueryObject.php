<?php

namespace GraphQL\SchemaObject;

class MergeRequestAuthorQueryObject extends QueryObject
{
    const OBJECT_NAME = "MergeRequestAuthor";

    public function selectAssignedMergeRequests(MergeRequestAuthorAssignedMergeRequestsArgumentsObject $argsObject = null)
    {
        $object = new MergeRequestConnectionQueryObject("assignedMergeRequests");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectAuthoredMergeRequests(MergeRequestAuthorAuthoredMergeRequestsArgumentsObject $argsObject = null)
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

    public function selectCallouts(MergeRequestAuthorCalloutsArgumentsObject $argsObject = null)
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

    public function selectEmails(MergeRequestAuthorEmailsArgumentsObject $argsObject = null)
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

    public function selectGroupMemberships(MergeRequestAuthorGroupMembershipsArgumentsObject $argsObject = null)
    {
        $object = new GroupMemberConnectionQueryObject("groupMemberships");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectGroups(MergeRequestAuthorGroupsArgumentsObject $argsObject = null)
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

    public function selectIde(MergeRequestAuthorIdeArgumentsObject $argsObject = null)
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

    public function selectMergeRequestInteraction(MergeRequestAuthorMergeRequestInteractionArgumentsObject $argsObject = null)
    {
        $object = new UserMergeRequestInteractionQueryObject("mergeRequestInteraction");
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

    public function selectNamespace(MergeRequestAuthorNamespaceArgumentsObject $argsObject = null)
    {
        $object = new NamespaceQueryObject("namespace");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNamespaceCommitEmails(MergeRequestAuthorNamespaceCommitEmailsArgumentsObject $argsObject = null)
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
    public function selectOrganizations(MergeRequestAuthorOrganizationsArgumentsObject $argsObject = null)
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

    public function selectProjectMemberships(MergeRequestAuthorProjectMembershipsArgumentsObject $argsObject = null)
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

    public function selectReviewRequestedMergeRequests(MergeRequestAuthorReviewRequestedMergeRequestsArgumentsObject $argsObject = null)
    {
        $object = new MergeRequestConnectionQueryObject("reviewRequestedMergeRequests");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSavedReplies(MergeRequestAuthorSavedRepliesArgumentsObject $argsObject = null)
    {
        $object = new SavedReplyConnectionQueryObject("savedReplies");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSavedReply(MergeRequestAuthorSavedReplyArgumentsObject $argsObject = null)
    {
        $object = new SavedReplyQueryObject("savedReply");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSnippets(MergeRequestAuthorSnippetsArgumentsObject $argsObject = null)
    {
        $object = new SnippetConnectionQueryObject("snippets");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectStarredProjects(MergeRequestAuthorStarredProjectsArgumentsObject $argsObject = null)
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

    public function selectStatus(MergeRequestAuthorStatusArgumentsObject $argsObject = null)
    {
        $object = new UserStatusQueryObject("status");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTimelogs(MergeRequestAuthorTimelogsArgumentsObject $argsObject = null)
    {
        $object = new TimelogConnectionQueryObject("timelogs");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTodos(MergeRequestAuthorTodosArgumentsObject $argsObject = null)
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
    public function selectUserAchievements(MergeRequestAuthorUserAchievementsArgumentsObject $argsObject = null)
    {
        $object = new UserAchievementConnectionQueryObject("userAchievements");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectUserPermissions(MergeRequestAuthorUserPermissionsArgumentsObject $argsObject = null)
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
