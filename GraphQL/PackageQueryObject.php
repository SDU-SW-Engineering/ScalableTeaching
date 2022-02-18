<?php

namespace GraphQL\SchemaObject;

class PackageQueryObject extends QueryObject
{
    const OBJECT_NAME = "Package";

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

    /**
     * @deprecated Due to scalability concerns, this field is going to be removed. Deprecated in 14.6.
     */
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

    public function selectVersion()
    {
        $this->selectField("version");

        return $this;
    }

    /**
     * @deprecated This field is now only returned in the PackageDetailsType. Deprecated in 13.11.
     */
    public function selectVersions(PackageVersionsArgumentsObject $argsObject = null)
    {
        $object = new PackageConnectionQueryObject("versions");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
