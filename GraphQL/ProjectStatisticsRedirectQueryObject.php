<?php

namespace GraphQL\SchemaObject;

class ProjectStatisticsRedirectQueryObject extends QueryObject
{
    const OBJECT_NAME = "ProjectStatisticsRedirect";

    public function selectBuildArtifacts()
    {
        $this->selectField("buildArtifacts");

        return $this;
    }

    public function selectContainerRegistry()
    {
        $this->selectField("containerRegistry");

        return $this;
    }

    public function selectPackages()
    {
        $this->selectField("packages");

        return $this;
    }

    public function selectRepository()
    {
        $this->selectField("repository");

        return $this;
    }

    public function selectSnippets()
    {
        $this->selectField("snippets");

        return $this;
    }

    public function selectWiki()
    {
        $this->selectField("wiki");

        return $this;
    }
}
