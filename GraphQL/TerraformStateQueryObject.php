<?php

namespace GraphQL\SchemaObject;

class TerraformStateQueryObject extends QueryObject
{
    const OBJECT_NAME = "TerraformState";

    public function selectCreatedAt()
    {
        $this->selectField("createdAt");

        return $this;
    }

    public function selectDeletedAt()
    {
        $this->selectField("deletedAt");

        return $this;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectLatestVersion(TerraformStateLatestVersionArgumentsObject $argsObject = null)
    {
        $object = new TerraformStateVersionQueryObject("latestVersion");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectLockedAt()
    {
        $this->selectField("lockedAt");

        return $this;
    }

    public function selectLockedByUser(TerraformStateLockedByUserArgumentsObject $argsObject = null)
    {
        $object = new UserCoreQueryObject("lockedByUser");
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

    public function selectUpdatedAt()
    {
        $this->selectField("updatedAt");

        return $this;
    }
}
