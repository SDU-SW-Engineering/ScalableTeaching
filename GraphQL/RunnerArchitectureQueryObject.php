<?php

namespace GraphQL\SchemaObject;

class RunnerArchitectureQueryObject extends QueryObject
{
    const OBJECT_NAME = "RunnerArchitecture";

    public function selectDownloadLocation()
    {
        $this->selectField("downloadLocation");

        return $this;
    }

    public function selectName()
    {
        $this->selectField("name");

        return $this;
    }
}
