<?php

namespace GraphQL\SchemaObject;

class RootStorageStatisticsQueryObject extends QueryObject
{
    const OBJECT_NAME = "RootStorageStatistics";

    public function selectBuildArtifactsSize()
    {
        $this->selectField("buildArtifactsSize");

        return $this;
    }

    public function selectLfsObjectsSize()
    {
        $this->selectField("lfsObjectsSize");

        return $this;
    }

    public function selectPackagesSize()
    {
        $this->selectField("packagesSize");

        return $this;
    }

    public function selectPipelineArtifactsSize()
    {
        $this->selectField("pipelineArtifactsSize");

        return $this;
    }

    public function selectRepositorySize()
    {
        $this->selectField("repositorySize");

        return $this;
    }

    public function selectSnippetsSize()
    {
        $this->selectField("snippetsSize");

        return $this;
    }

    public function selectStorageSize()
    {
        $this->selectField("storageSize");

        return $this;
    }

    public function selectUploadsSize()
    {
        $this->selectField("uploadsSize");

        return $this;
    }

    public function selectWikiSize()
    {
        $this->selectField("wikiSize");

        return $this;
    }
}
