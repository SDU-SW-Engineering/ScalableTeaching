<?php

namespace GraphQL\SchemaObject;

class MLModelVersionLinksQueryObject extends QueryObject
{
    const OBJECT_NAME = "MLModelVersionLinks";

    public function selectPackagePath()
    {
        $this->selectField("packagePath");

        return $this;
    }

    public function selectShowPath()
    {
        $this->selectField("showPath");

        return $this;
    }
}
