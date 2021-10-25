<?php

namespace GraphQL\SchemaObject;

class MergeRequestAssigneeQueryObject extends QueryObject
{
    const OBJECT_NAME = "MergeRequestAssignee";

    public function selectAssignedMergeRequests(MergeRequestAssigneeAssignedMergeRequestsArgumentsObject $argsObject = null)
    {
        $object = new MergeRequestConnectionQueryObject("assignedMergeRequests");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectAuthoredMergeRequests(MergeRequestAssigneeAuthoredMergeRequestsArgumentsObject $argsObject = null)
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

    public function selectBot()
    {
        $this->selectField("bot");

        return $this;
    }

    public function selectCallouts(MergeRequestAssigneeCalloutsArgumentsObject $argsObject = null)
    {
        $object = new UserCalloutConnectionQueryObject("callouts");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    /**
     * @deprecated This was renamed. Please use `User.publicEmail`. Deprecated in 13.7.
     */
    public function selectEmail()
    {
        $this->selectField("email");

        return $this;
    }

    public function selectGroupCount()
    {
        $this->selectField("groupCount");

        return $this;
    }

    public function selectGroupMemberships(MergeRequestAssigneeGroupMembershipsArgumentsObject $argsObject = null)
    {
        $object = new GroupMemberConnectionQueryObject("groupMemberships");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectGroups(MergeRequestAssigneeGroupsArgumentsObject $argsObject = null)
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

    public function selectLocation()
    {
        $this->selectField("location");

        return $this;
    }

    public function selectMergeRequestInteraction(MergeRequestAssigneeMergeRequestInteractionArgumentsObject $argsObject = null)
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

    public function selectNamespace(MergeRequestAssigneeNamespaceArgumentsObject $argsObject = null)
    {
        $object = new NamespaceQueryObject("namespace");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectProjectMemberships(MergeRequestAssigneeProjectMembershipsArgumentsObject $argsObject = null)
    {
        $object = new ProjectMemberConnectionQueryObject("projectMemberships");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPublicEmail()
    {
        $this->selectField("publicEmail");

        return $this;
    }

    public function selectReviewRequestedMergeRequests(MergeRequestAssigneeReviewRequestedMergeRequestsArgumentsObject $argsObject = null)
    {
        $object = new MergeRequestConnectionQueryObject("reviewRequestedMergeRequests");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSnippets(MergeRequestAssigneeSnippetsArgumentsObject $argsObject = null)
    {
        $object = new SnippetConnectionQueryObject("snippets");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectStarredProjects(MergeRequestAssigneeStarredProjectsArgumentsObject $argsObject = null)
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

    public function selectStatus(MergeRequestAssigneeStatusArgumentsObject $argsObject = null)
    {
        $object = new UserStatusQueryObject("status");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTimelogs(MergeRequestAssigneeTimelogsArgumentsObject $argsObject = null)
    {
        $object = new TimelogConnectionQueryObject("timelogs");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTodos(MergeRequestAssigneeTodosArgumentsObject $argsObject = null)
    {
        $object = new TodoConnectionQueryObject("todos");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectUserPermissions(MergeRequestAssigneeUserPermissionsArgumentsObject $argsObject = null)
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
