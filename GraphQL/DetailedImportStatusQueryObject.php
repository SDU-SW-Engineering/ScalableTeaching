<?php

namespace GraphQL\SchemaObject;

class DetailedImportStatusQueryObject extends QueryObject
{
    const OBJECT_NAME = "DetailedImportStatus";

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectLastError()
    {
        $this->selectField("lastError");

        return $this;
    }

    public function selectLastSuccessfulUpdateAt()
    {
        $this->selectField("lastSuccessfulUpdateAt");

        return $this;
    }

    public function selectLastUpdateAt()
    {
        $this->selectField("lastUpdateAt");

        return $this;
    }

    public function selectLastUpdateStartedAt()
    {
        $this->selectField("lastUpdateStartedAt");

        return $this;
    }

    public function selectStatus()
    {
        $this->selectField("status");

        return $this;
    }

    public function selectUrl()
    {
        $this->selectField("url");

        return $this;
    }
}
