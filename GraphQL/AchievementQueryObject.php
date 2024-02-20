<?php

namespace GraphQL\SchemaObject;

class AchievementQueryObject extends QueryObject
{
    const OBJECT_NAME = "Achievement";

    public function selectAvatarUrl()
    {
        $this->selectField("avatarUrl");

        return $this;
    }

    public function selectCreatedAt()
    {
        $this->selectField("createdAt");

        return $this;
    }

    public function selectDescription()
    {
        $this->selectField("description");

        return $this;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectName()
    {
        $this->selectField("name");

        return $this;
    }

    public function selectNamespace(AchievementNamespaceArgumentsObject $argsObject = null)
    {
        $object = new NamespaceQueryObject("namespace");
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

    /**
     * @deprecated **Status**: Experiment. Introduced in 15.10.
     */
    public function selectUserAchievements(AchievementUserAchievementsArgumentsObject $argsObject = null)
    {
        $object = new UserAchievementConnectionQueryObject("userAchievements");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
