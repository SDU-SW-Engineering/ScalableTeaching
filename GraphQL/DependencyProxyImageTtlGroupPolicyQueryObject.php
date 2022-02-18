<?php

namespace GraphQL\SchemaObject;

class DependencyProxyImageTtlGroupPolicyQueryObject extends QueryObject
{
    const OBJECT_NAME = "DependencyProxyImageTtlGroupPolicy";

    public function selectCreatedAt()
    {
        $this->selectField("createdAt");

        return $this;
    }

    public function selectEnabled()
    {
        $this->selectField("enabled");

        return $this;
    }

    public function selectTtl()
    {
        $this->selectField("ttl");

        return $this;
    }

    public function selectUpdatedAt()
    {
        $this->selectField("updatedAt");

        return $this;
    }
}
