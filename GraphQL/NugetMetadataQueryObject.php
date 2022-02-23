<?php

namespace GraphQL\SchemaObject;

class NugetMetadataQueryObject extends QueryObject
{
    const OBJECT_NAME = "NugetMetadata";

    public function selectIconUrl()
    {
        $this->selectField("iconUrl");

        return $this;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectLicenseUrl()
    {
        $this->selectField("licenseUrl");

        return $this;
    }

    public function selectProjectUrl()
    {
        $this->selectField("projectUrl");

        return $this;
    }
}
