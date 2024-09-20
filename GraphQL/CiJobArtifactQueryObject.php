<?php

namespace GraphQL\SchemaObject;

class CiJobArtifactQueryObject extends QueryObject
{
    const OBJECT_NAME = "CiJobArtifact";

    public function selectDownloadPath()
    {
        $this->selectField("downloadPath");

        return $this;
    }

    public function selectExpireAt()
    {
        $this->selectField("expireAt");

        return $this;
    }

    public function selectFileType()
    {
        $this->selectField("fileType");

        return $this;
    }

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

    public function selectSize()
    {
        $this->selectField("size");

        return $this;
    }
}
