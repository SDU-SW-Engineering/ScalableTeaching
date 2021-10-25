<?php

namespace GraphQL\SchemaObject;

class PackageDetailsTypeQueryObject extends QueryObject
{
    const OBJECT_NAME = "PackageDetailsType";

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

    public function selectDependencyLinks(PackageDetailsTypeDependencyLinksArgumentsObject $argsObject = null)
    {
        $object = new PackageDependencyLinkConnectionQueryObject("dependencyLinks");
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

    public function selectMetadata(PackageDetailsTypeMetadataArgumentsObject $argsObject = null)
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

    public function selectPackageFiles(PackageDetailsTypePackageFilesArgumentsObject $argsObject = null)
    {
        $object = new PackageFileConnectionQueryObject("packageFiles");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPackageType()
    {
        $this->selectField("packageType");

        return $this;
    }

    public function selectPipelines(PackageDetailsTypePipelinesArgumentsObject $argsObject = null)
    {
        $object = new PipelineConnectionQueryObject("pipelines");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectProject(PackageDetailsTypeProjectArgumentsObject $argsObject = null)
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

    public function selectTags(PackageDetailsTypeTagsArgumentsObject $argsObject = null)
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

    public function selectVersion()
    {
        $this->selectField("version");

        return $this;
    }

    public function selectVersions(PackageDetailsTypeVersionsArgumentsObject $argsObject = null)
    {
        $object = new PackageConnectionQueryObject("versions");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
