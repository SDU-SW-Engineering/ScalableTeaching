<?php

namespace GraphQL\SchemaObject;

class ProjectMemberQueryObject extends QueryObject
{
    const OBJECT_NAME = "ProjectMember";

    public function selectAccessLevel(ProjectMemberAccessLevelArgumentsObject $argsObject = null)
    {
        $object = new AccessLevelQueryObject("accessLevel");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCreatedAt()
    {
        $this->selectField("createdAt");

        return $this;
    }

    public function selectCreatedBy(ProjectMemberCreatedByArgumentsObject $argsObject = null)
    {
        $object = new UserCoreQueryObject("createdBy");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectExpiresAt()
    {
        $this->selectField("expiresAt");

        return $this;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectMergeRequestInteraction(ProjectMemberMergeRequestInteractionArgumentsObject $argsObject = null)
    {
        $object = new UserMergeRequestInteractionQueryObject("mergeRequestInteraction");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectProject(ProjectMemberProjectArgumentsObject $argsObject = null)
    {
        $object = new ProjectQueryObject("project");
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

    public function selectUser(ProjectMemberUserArgumentsObject $argsObject = null)
    {
        $object = new UserCoreQueryObject("user");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectUserPermissions(ProjectMemberUserPermissionsArgumentsObject $argsObject = null)
    {
        $object = new ProjectPermissionsQueryObject("userPermissions");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
