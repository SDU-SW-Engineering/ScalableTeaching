<?php

namespace GraphQL\SchemaObject;

class GeoNodeQueryObject extends QueryObject
{
    const OBJECT_NAME = "GeoNode";

    public function selectContainerRepositoriesMaxCapacity()
    {
        $this->selectField("containerRepositoriesMaxCapacity");

        return $this;
    }

    public function selectEnabled()
    {
        $this->selectField("enabled");

        return $this;
    }

    public function selectFilesMaxCapacity()
    {
        $this->selectField("filesMaxCapacity");

        return $this;
    }

    public function selectGroupWikiRepositoryRegistries(GeoNodeGroupWikiRepositoryRegistriesArgumentsObject $argsObject = null)
    {
        $object = new GroupWikiRepositoryRegistryConnectionQueryObject("groupWikiRepositoryRegistries");
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

    public function selectInternalUrl()
    {
        $this->selectField("internalUrl");

        return $this;
    }

    public function selectLfsObjectRegistries(GeoNodeLfsObjectRegistriesArgumentsObject $argsObject = null)
    {
        $object = new LfsObjectRegistryConnectionQueryObject("lfsObjectRegistries");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectMergeRequestDiffRegistries(GeoNodeMergeRequestDiffRegistriesArgumentsObject $argsObject = null)
    {
        $object = new MergeRequestDiffRegistryConnectionQueryObject("mergeRequestDiffRegistries");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectMinimumReverificationInterval()
    {
        $this->selectField("minimumReverificationInterval");

        return $this;
    }

    public function selectName()
    {
        $this->selectField("name");

        return $this;
    }

    public function selectPackageFileRegistries(GeoNodePackageFileRegistriesArgumentsObject $argsObject = null)
    {
        $object = new PackageFileRegistryConnectionQueryObject("packageFileRegistries");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPagesDeploymentRegistries(GeoNodePagesDeploymentRegistriesArgumentsObject $argsObject = null)
    {
        $object = new PagesDeploymentRegistryConnectionQueryObject("pagesDeploymentRegistries");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPipelineArtifactRegistries(GeoNodePipelineArtifactRegistriesArgumentsObject $argsObject = null)
    {
        $object = new PipelineArtifactRegistryConnectionQueryObject("pipelineArtifactRegistries");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPrimary()
    {
        $this->selectField("primary");

        return $this;
    }

    public function selectReposMaxCapacity()
    {
        $this->selectField("reposMaxCapacity");

        return $this;
    }

    public function selectSelectiveSyncNamespaces(GeoNodeSelectiveSyncNamespacesArgumentsObject $argsObject = null)
    {
        $object = new NamespaceConnectionQueryObject("selectiveSyncNamespaces");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSelectiveSyncShards()
    {
        $this->selectField("selectiveSyncShards");

        return $this;
    }

    public function selectSelectiveSyncType()
    {
        $this->selectField("selectiveSyncType");

        return $this;
    }

    public function selectSnippetRepositoryRegistries(GeoNodeSnippetRepositoryRegistriesArgumentsObject $argsObject = null)
    {
        $object = new SnippetRepositoryRegistryConnectionQueryObject("snippetRepositoryRegistries");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSyncObjectStorage()
    {
        $this->selectField("syncObjectStorage");

        return $this;
    }

    public function selectTerraformStateVersionRegistries(GeoNodeTerraformStateVersionRegistriesArgumentsObject $argsObject = null)
    {
        $object = new TerraformStateVersionRegistryConnectionQueryObject("terraformStateVersionRegistries");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectUploadRegistries(GeoNodeUploadRegistriesArgumentsObject $argsObject = null)
    {
        $object = new UploadRegistryConnectionQueryObject("uploadRegistries");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectUrl()
    {
        $this->selectField("url");

        return $this;
    }

    public function selectVerificationMaxCapacity()
    {
        $this->selectField("verificationMaxCapacity");

        return $this;
    }
}
