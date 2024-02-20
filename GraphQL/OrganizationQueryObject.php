<?php

namespace GraphQL\SchemaObject;

class OrganizationQueryObject extends QueryObject
{
    const OBJECT_NAME = "Organization";

    /**
     * @deprecated **Status**: Experiment. Introduced in 16.7.
     */
    public function selectAvatarUrl()
    {
        $this->selectField("avatarUrl");

        return $this;
    }

    /**
     * @deprecated **Status**: Experiment. Introduced in 16.7.
     */
    public function selectDescription()
    {
        $this->selectField("description");

        return $this;
    }

    /**
     * @deprecated **Status**: Experiment. Introduced in 16.7.
     */
    public function selectDescriptionHtml()
    {
        $this->selectField("descriptionHtml");

        return $this;
    }

    /**
     * @deprecated **Status**: Experiment. Introduced in 16.4.
     */
    public function selectGroups(OrganizationGroupsArgumentsObject $argsObject = null)
    {
        $object = new GroupConnectionQueryObject("groups");
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
    public function selectName()
    {
        $this->selectField("name");

        return $this;
    }

    /**
     * @deprecated **Status**: Experiment. Introduced in 16.4.
     */
    public function selectOrganizationUsers(OrganizationOrganizationUsersArgumentsObject $argsObject = null)
    {
        $object = new OrganizationUserConnectionQueryObject("organizationUsers");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    /**
     * @deprecated **Status**: Experiment. Introduced in 16.4.
     */
    public function selectPath()
    {
        $this->selectField("path");

        return $this;
    }

    /**
     * @deprecated **Status**: Experiment. Introduced in 16.8.
     */
    public function selectProjects(OrganizationProjectsArgumentsObject $argsObject = null)
    {
        $object = new ProjectConnectionQueryObject("projects");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    /**
     * @deprecated **Status**: Experiment. Introduced in 16.6.
     */
    public function selectWebUrl()
    {
        $this->selectField("webUrl");

        return $this;
    }
}
