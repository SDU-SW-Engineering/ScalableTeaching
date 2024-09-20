<?php

namespace GraphQL\SchemaObject;

class PackagesCleanupPolicyQueryObject extends QueryObject
{
    const OBJECT_NAME = "PackagesCleanupPolicy";

    public function selectKeepNDuplicatedPackageFiles()
    {
        $this->selectField("keepNDuplicatedPackageFiles");

        return $this;
    }

    public function selectNextRunAt()
    {
        $this->selectField("nextRunAt");

        return $this;
    }
}
