<?php

namespace GraphQL\SchemaObject;

class ContainerRepositoryTagQueryObject extends QueryObject
{
    const OBJECT_NAME = "ContainerRepositoryTag";

    /**
     * @deprecated Use `userPermissions` field. See `ContainerRepositoryTagPermissions` type. Deprecated in 16.7.
     */
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

    public function selectDigest()
    {
        $this->selectField("digest");

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

    public function selectPublishedAt()
    {
        $this->selectField("publishedAt");

        return $this;
    }

    public function selectReferrers(ContainerRepositoryTagReferrersArgumentsObject $argsObject = null)
    {
        $object = new ContainerRepositoryReferrerQueryObject("referrers");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRevision()
    {
        $this->selectField("revision");

        return $this;
    }

    public function selectShortRevision()
    {
        $this->selectField("shortRevision");

        return $this;
    }

    public function selectTotalSize()
    {
        $this->selectField("totalSize");

        return $this;
    }

    public function selectUserPermissions(ContainerRepositoryTagUserPermissionsArgumentsObject $argsObject = null)
    {
        $object = new ContainerRepositoryTagPermissionsQueryObject("userPermissions");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
