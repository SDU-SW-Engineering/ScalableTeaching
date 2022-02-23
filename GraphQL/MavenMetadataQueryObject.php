<?php

namespace GraphQL\SchemaObject;

class MavenMetadataQueryObject extends QueryObject
{
    const OBJECT_NAME = "MavenMetadata";

    public function selectAppGroup()
    {
        $this->selectField("appGroup");

        return $this;
    }

    public function selectAppName()
    {
        $this->selectField("appName");

        return $this;
    }

    public function selectAppVersion()
    {
        $this->selectField("appVersion");

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

    public function selectPath()
    {
        $this->selectField("path");

        return $this;
    }

    public function selectUpdatedAt()
    {
        $this->selectField("updatedAt");

        return $this;
    }
}
