<?php

namespace GraphQL\SchemaObject;

class ContainerRepositoryTagQueryObject extends QueryObject
{
    const OBJECT_NAME = "ContainerRepositoryTag";

    public function selectCanDelete()
    {
        $this->selectField("canDelete");

        return $this;
    }

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

    public function selectLocation()
    {
        $this->selectField("location");

        return $this;
    }

    public function selectName()
    {
        $this->selectField("name");

        return $this;
    }

    public function selectPath()
    {
        $this->selectField("path");

        return $this;
    }

    public function selectRevision()
    {
        $this->selectField("revision");

        return $this;
    }

    public function selectShortRevision()
    {
        $this->selectField("shortRevision");

        return $this;
    }

    public function selectTotalSize()
    {
        $this->selectField("totalSize");

        return $this;
    }
}
