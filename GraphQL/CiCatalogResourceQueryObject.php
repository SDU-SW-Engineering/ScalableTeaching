<?php

namespace GraphQL\SchemaObject;

class CiCatalogResourceQueryObject extends QueryObject
{
    const OBJECT_NAME = "CiCatalogResource";

    /**
     * @deprecated **Status**: Experiment. Introduced in 15.11.
     */
    public function selectDescription()
    {
        $this->selectField("description");

        return $this;
    }

    /**
     * @deprecated **Status**: Experiment. Introduced in 15.11.
     */
    public function selectIcon()
    {
        $this->selectField("icon");

        return $this;
    }

    /**
     * @deprecated **Status**: Experiment. Introduced in 15.11.
     */
    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    /**
     * @deprecated **Status**: Experiment. Introduced in 16.5.
     */
    public function selectLatestReleasedAt()
    {
        $this->selectField("latestReleasedAt");

        return $this;
    }

    /**
     * @deprecated **Status**: Experiment. Introduced in 16.1.
     */
    public function selectLatestVersion(CiCatalogResourceLatestVersionArgumentsObject $argsObject = null)
    {
        $object = new CiCatalogResourceVersionQueryObject("latestVersion");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    /**
     * @deprecated **Status**: Experiment. Introduced in 15.11.
     */
    public function selectName()
    {
        $this->selectField("name");

        return $this;
    }

    /**
     * @deprecated **Status**: Experiment. Introduced in 16.3.
     */
    public function selectOpenIssuesCount()
    {
        $this->selectField("openIssuesCount");

        return $this;
    }

    /**
     * @deprecated **Status**: Experiment. Introduced in 16.3.
     */
    public function selectOpenMergeRequestsCount()
    {
        $this->selectField("openMergeRequestsCount");

        return $this;
    }

    /**
     * @deprecated **Status**: Experiment. Introduced in 16.1.
     */
    public function selectStarCount()
    {
        $this->selectField("starCount");

        return $this;
    }

    /**
     * @deprecated **Status**: Experiment. Introduced in 16.9.
     */
    public function selectVerificationLevel()
    {
        $this->selectField("verificationLevel");

        return $this;
    }

    /**
     * @deprecated **Status**: Experiment. Introduced in 16.2.
     */
    public function selectVersions(CiCatalogResourceVersionsArgumentsObject $argsObject = null)
    {
        $object = new CiCatalogResourceVersionConnectionQueryObject("versions");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    /**
     * @deprecated **Status**: Experiment. Introduced in 16.1.
     */
    public function selectWebPath()
    {
        $this->selectField("webPath");

        return $this;
    }
}
