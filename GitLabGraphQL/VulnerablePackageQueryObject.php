<?php

namespace GraphQL\SchemaObject;

class VulnerablePackageQueryObject extends QueryObject
{
    const OBJECT_NAME = "VulnerablePackage";

    public function selectName()
    {
        $this->selectField("name");

        return $this;
    }
}
