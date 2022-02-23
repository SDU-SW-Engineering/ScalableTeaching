<?php

namespace GraphQL\SchemaObject;

class ContainerRepositoryQueryObject extends QueryObject
{
    const OBJECT_NAME = "ContainerRepository";

    public function selectCanDelete()
    {
        $this->selectField("canDelete");

        return $this;
    }

    public function selectCreatedAt()
    {
        $this->selectField("createdAt");

        return $this;
    }

    public function selectExpirationPolicyCleanupStatus()
    {
        $this->selectField("expirationPolicyCleanupStatus");

        return $this;
    }

    public function selectExpirationPolicyStartedAt()
    {
        $this->selectField("expirationPolicyStartedAt");

        return $this;
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

    public function selectName()
    {
        $this->selectField("name");

        return $this;
    }

    public function selectPath()
    {
        $this->selectField("path");

        return $this;
    }

    public function selectProject(ContainerRepositoryProjectArgumentsObject $argsObject = null)
    {
        $object = new ProjectQueryObject("project");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectStatus()
    {
        $this->selectField("status");

        return $this;
    }

    public function selectTagsCount()
    {
        $this->selectField("tagsCount");

        return $this;
    }

    public function selectUpdatedAt()
    {
        $this->selectField("updatedAt");

        return $this;
    }
}
