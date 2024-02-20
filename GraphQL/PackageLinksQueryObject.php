<?php

namespace GraphQL\SchemaObject;

class PackageLinksQueryObject extends QueryObject
{
    const OBJECT_NAME = "PackageLinks";

    public function selectWebPath()
    {
        $this->selectField("webPath");

        return $this;
    }
}
