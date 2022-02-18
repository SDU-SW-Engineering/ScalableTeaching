<?php

namespace GraphQL\SchemaObject;

class DependencyProxyBlobQueryObject extends QueryObject
{
    const OBJECT_NAME = "DependencyProxyBlob";

    public function selectCreatedAt()
    {
        $this->selectField("createdAt");

        return $this;
    }

    public function selectFileName()
    {
        $this->selectField("fileName");

        return $this;
    }

    public function selectSize()
    {
        $this->selectField("size");

        return $this;
    }

    public function selectUpdatedAt()
    {
        $this->selectField("updatedAt");

        return $this;
    }
}
