<?php

namespace GraphQL\SchemaObject;

class PackagesProtectionRuleQueryObject extends QueryObject
{
    const OBJECT_NAME = "PackagesProtectionRule";

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectPackageNamePattern()
    {
        $this->selectField("packageNamePattern");

        return $this;
    }

    public function selectPackageType()
    {
        $this->selectField("packageType");

        return $this;
    }

    public function selectPushProtectedUpToAccessLevel()
    {
        $this->selectField("pushProtectedUpToAccessLevel");

        return $this;
    }
}
