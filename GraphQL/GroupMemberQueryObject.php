<?php

namespace GraphQL\SchemaObject;

class GroupMemberQueryObject extends QueryObject
{
    const OBJECT_NAME = "GroupMember";

    public function selectAccessLevel(GroupMemberAccessLevelArgumentsObject $argsObject = null)
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

    public function selectCreatedBy(GroupMemberCreatedByArgumentsObject $argsObject = null)
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

    public function selectGroup(GroupMemberGroupArgumentsObject $argsObject = null)
    {
        $object = new GroupQueryObject("group");
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

    public function selectMergeRequestInteraction(GroupMemberMergeRequestInteractionArgumentsObject $argsObject = null)
    {
        $object = new UserMergeRequestInteractionQueryObject("mergeRequestInteraction");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNotificationEmail()
    {
        $this->selectField("notificationEmail");

        return $this;
    }

    public function selectUpdatedAt()
    {
        $this->selectField("updatedAt");

        return $this;
    }

    public function selectUser(GroupMemberUserArgumentsObject $argsObject = null)
    {
        $object = new UserCoreQueryObject("user");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectUserPermissions(GroupMemberUserPermissionsArgumentsObject $argsObject = null)
    {
        $object = new GroupPermissionsQueryObject("userPermissions");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
