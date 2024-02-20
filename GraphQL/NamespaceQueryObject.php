<?php

namespace GraphQL\SchemaObject;

class NamespaceQueryObject extends QueryObject
{
    const OBJECT_NAME = "Namespace";

    /**
     * @deprecated **Status**: Experiment. Introduced in 15.8.
     */
    public function selectAchievements(NamespaceAchievementsArgumentsObject $argsObject = null)
    {
        $object = new AchievementConnectionQueryObject("achievements");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCrossProjectPipelineAvailable()
    {
        $this->selectField("crossProjectPipelineAvailable");

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

    /**
     * @deprecated **Status**: Experiment. Introduced in 15.3.
     */
    public function selectTimelogCategories(NamespaceTimelogCategoriesArgumentsObject $argsObject = null)
    {
        $object = new TimeTrackingTimelogCategoryConnectionQueryObject("timelogCategories");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectVisibility()
    {
        $this->selectField("visibility");

        return $this;
    }
}
