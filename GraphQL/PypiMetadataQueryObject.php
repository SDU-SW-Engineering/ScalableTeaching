<?php

namespace GraphQL\SchemaObject;

class PypiMetadataQueryObject extends QueryObject
{
    const OBJECT_NAME = "PypiMetadata";

    public function selectAuthorEmail()
    {
        $this->selectField("authorEmail");

        return $this;
    }

    public function selectDescription()
    {
        $this->selectField("description");

        return $this;
    }

    public function selectDescriptionContentType()
    {
        $this->selectField("descriptionContentType");

        return $this;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectKeywords()
    {
        $this->selectField("keywords");

        return $this;
    }

    public function selectMetadataVersion()
    {
        $this->selectField("metadataVersion");

        return $this;
    }

    public function selectRequiredPython()
    {
        $this->selectField("requiredPython");

        return $this;
    }

    public function selectSummary()
    {
        $this->selectField("summary");

        return $this;
    }
}
