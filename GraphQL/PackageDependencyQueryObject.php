<?php

namespace GraphQL\SchemaObject;

class PackageDependencyQueryObject extends QueryObject
{
    const OBJECT_NAME = "PackageDependency";

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectName()
    {
        $this->selectField("name");

        return $this;
    }

    public function selectVersionPattern()
    {
        $this->selectField("versionPattern");

        return $this;
    }
}
