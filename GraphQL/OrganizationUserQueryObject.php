<?php

namespace GraphQL\SchemaObject;

class OrganizationUserQueryObject extends QueryObject
{
    const OBJECT_NAME = "OrganizationUser";

    /**
     * @deprecated **Status**: Experiment. Introduced in 16.4.
     */
    public function selectBadges(OrganizationUserBadgesArgumentsObject $argsObject = null)
    {
        $object = new OrganizationUserBadgeQueryObject("badges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    /**
     * @deprecated **Status**: Experiment. Introduced in 16.4.
     */
    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    /**
     * @deprecated **Status**: Experiment. Introduced in 16.4.
     */
    public function selectUser(OrganizationUserUserArgumentsObject $argsObject = null)
    {
        $object = new UserCoreQueryObject("user");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
