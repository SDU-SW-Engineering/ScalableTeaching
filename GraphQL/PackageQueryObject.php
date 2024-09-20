<?php

namespace GraphQL\SchemaObject;

class PackageQueryObject extends QueryObject
{
    const OBJECT_NAME = "Package";

    public function selectLinks(PackageLinksArgumentsObject $argsObject = null)
    {
        $object = new PackageLinksQueryObject("_links");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    /**
     * @deprecated Superseded by `user_permissions` field. See `Types::PermissionTypes::Package` type. Deprecated in 16.6.
     */
    public function selectCanDestroy()
    {
        $this->selectField("canDestroy");

        return $this;
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

    public function selectMetadata(PackageMetadataArgumentsObject $argsObject = null)
    {
        $object = new PackageMetadataUnionObject("metadata");
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

    public function selectPackageType()
    {
        $this->selectField("packageType");

        return $this;
    }

    public function selectPipelines(PackagePipelinesArgumentsObject $argsObject = null)
    {
        $object = new PipelineConnectionQueryObject("pipelines");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectProject(PackageProjectArgumentsObject $argsObject = null)
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

    public function selectStatusMessage()
    {
        $this->selectField("statusMessage");

        return $this;
    }

    public function selectTags(PackageTagsArgumentsObject $argsObject = null)
    {
        $object = new PackageTagConnectionQueryObject("tags");
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

    public function selectUserPermissions(PackageUserPermissionsArgumentsObject $argsObject = null)
    {
        $object = new PackagePermissionsQueryObject("userPermissions");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectVersion()
    {
        $this->selectField("version");

        return $this;
    }
}
