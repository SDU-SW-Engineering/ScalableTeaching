<?php

namespace GraphQL\SchemaObject;

class PackageComposerJsonTypeQueryObject extends QueryObject
{
    const OBJECT_NAME = "PackageComposerJsonType";

    public function selectLicense()
    {
        $this->selectField("license");

        return $this;
    }

    public function selectName()
    {
        $this->selectField("name");

        return $this;
    }

    public function selectType()
    {
        $this->selectField("type");

        return $this;
    }

    public function selectVersion()
    {
        $this->selectField("version");

        return $this;
    }
}
