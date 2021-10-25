<?php

namespace GraphQL\SchemaObject;

class PackageFileQueryObject extends QueryObject
{
    const OBJECT_NAME = "PackageFile";

    public function selectCreatedAt()
    {
        $this->selectField("createdAt");

        return $this;
    }

    public function selectDownloadPath()
    {
        $this->selectField("downloadPath");

        return $this;
    }

    public function selectFileMd5()
    {
        $this->selectField("fileMd5");

        return $this;
    }

    public function selectFileName()
    {
        $this->selectField("fileName");

        return $this;
    }

    public function selectFileSha1()
    {
        $this->selectField("fileSha1");

        return $this;
    }

    public function selectFileSha256()
    {
        $this->selectField("fileSha256");

        return $this;
    }

    public function selectId()
    {
        $this->selectField("id");

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
