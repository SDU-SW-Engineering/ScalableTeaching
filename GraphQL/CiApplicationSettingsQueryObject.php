<?php

namespace GraphQL\SchemaObject;

class CiApplicationSettingsQueryObject extends QueryObject
{
    const OBJECT_NAME = "CiApplicationSettings";

    public function selectKeepLatestArtifact()
    {
        $this->selectField("keepLatestArtifact");

        return $this;
    }
}
