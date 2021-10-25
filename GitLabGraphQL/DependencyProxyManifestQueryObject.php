<?php

namespace GraphQL\SchemaObject;

class DependencyProxyManifestQueryObject extends QueryObject
{
    const OBJECT_NAME = "DependencyProxyManifest";

    public function selectCreatedAt()
    {
        $this->selectField("createdAt");

        return $this;
    }

    public function selectDigest()
    {
        $this->selectField("digest");

        return $this;
    }

    public function selectFileName()
    {
        $this->selectField("fileName");

        return $this;
    }

    public function selectImageName()
    {
        $this->selectField("imageName");

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
