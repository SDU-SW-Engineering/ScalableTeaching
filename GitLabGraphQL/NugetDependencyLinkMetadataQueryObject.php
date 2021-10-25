<?php

namespace GraphQL\SchemaObject;

class NugetDependencyLinkMetadataQueryObject extends QueryObject
{
    const OBJECT_NAME = "NugetDependencyLinkMetadata";

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectTargetFramework()
    {
        $this->selectField("targetFramework");

        return $this;
    }
}
