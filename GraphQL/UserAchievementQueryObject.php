<?php

namespace GraphQL\SchemaObject;

class UserAchievementQueryObject extends QueryObject
{
    const OBJECT_NAME = "UserAchievement";

    public function selectAchievement(UserAchievementAchievementArgumentsObject $argsObject = null)
    {
        $object = new AchievementQueryObject("achievement");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectAwardedByUser(UserAchievementAwardedByUserArgumentsObject $argsObject = null)
    {
        $object = new UserCoreQueryObject("awardedByUser");
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

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectPriority()
    {
        $this->selectField("priority");

        return $this;
    }

    public function selectRevokedAt()
    {
        $this->selectField("revokedAt");

        return $this;
    }

    public function selectRevokedByUser(UserAchievementRevokedByUserArgumentsObject $argsObject = null)
    {
        $object = new UserCoreQueryObject("revokedByUser");
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

    public function selectUser(UserAchievementUserArgumentsObject $argsObject = null)
    {
        $object = new UserCoreQueryObject("user");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
