<?php

namespace GraphQL\SchemaObject;

class NamespaceQueryObject extends QueryObject
{
    const OBJECT_NAME = "Namespace";

    public function selectActualRepositorySizeLimit()
    {
        $this->selectField("actualRepositorySizeLimit");

        return $this;
    }

    public function selectAdditionalPurchasedStorageSize()
    {
        $this->selectField("additionalPurchasedStorageSize");

        return $this;
    }

    public function selectComplianceFrameworks(NamespaceComplianceFrameworksArgumentsObject $argsObject = null)
    {
        $object = new ComplianceFrameworkConnectionQueryObject("complianceFrameworks");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectContainsLockedProjects()
    {
        $this->selectField("containsLockedProjects");

        return $this;
    }

    public function selectDescription()
    {
        $this->selectField("description");

        return $this;
    }

    public function selectDescriptionHtml()
    {
        $this->selectField("descriptionHtml");

        return $this;
    }

    public function selectFullName()
    {
        $this->selectField("fullName");

        return $this;
    }

    public function selectFullPath()
    {
        $this->selectField("fullPath");

        return $this;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectIsTemporaryStorageIncreaseEnabled()
    {
        $this->selectField("isTemporaryStorageIncreaseEnabled");

        return $this;
    }

    public function selectLfsEnabled()
    {
        $this->selectField("lfsEnabled");

        return $this;
    }

    public function selectName()
    {
        $this->selectField("name");

        return $this;
    }

    public function selectPackageSettings(NamespacePackageSettingsArgumentsObject $argsObject = null)
    {
        $object = new PackageSettingsQueryObject("packageSettings");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPath()
    {
        $this->selectField("path");

        return $this;
    }

    public function selectProjects(NamespaceProjectsArgumentsObject $argsObject = null)
    {
        $object = new ProjectConnectionQueryObject("projects");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRepositorySizeExcessProjectCount()
    {
        $this->selectField("repositorySizeExcessProjectCount");

        return $this;
    }

    public function selectRequestAccessEnabled()
    {
        $this->selectField("requestAccessEnabled");

        return $this;
    }

    public function selectRootStorageStatistics(NamespaceRootStorageStatisticsArgumentsObject $argsObject = null)
    {
        $object = new RootStorageStatisticsQueryObject("rootStorageStatistics");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSharedRunnersSetting()
    {
        $this->selectField("sharedRunnersSetting");

        return $this;
    }

    public function selectStorageSizeLimit()
    {
        $this->selectField("storageSizeLimit");

        return $this;
    }

    public function selectTemporaryStorageIncreaseEndsOn()
    {
        $this->selectField("temporaryStorageIncreaseEndsOn");

        return $this;
    }

    public function selectTotalRepositorySize()
    {
        $this->selectField("totalRepositorySize");

        return $this;
    }

    public function selectTotalRepositorySizeExcess()
    {
        $this->selectField("totalRepositorySizeExcess");

        return $this;
    }

    public function selectVisibility()
    {
        $this->selectField("visibility");

        return $this;
    }
}
