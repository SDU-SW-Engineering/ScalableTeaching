<?php

namespace GraphQL\SchemaObject;

class UploadRegistryQueryObject extends QueryObject
{
    const OBJECT_NAME = "UploadRegistry";

    public function selectCreatedAt()
    {
        $this->selectField("createdAt");

        return $this;
    }

    public function selectFileId()
    {
        $this->selectField("fileId");

        return $this;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectLastSyncFailure()
    {
        $this->selectField("lastSyncFailure");

        return $this;
    }

    public function selectLastSyncedAt()
    {
        $this->selectField("lastSyncedAt");

        return $this;
    }

    public function selectRetryAt()
    {
        $this->selectField("retryAt");

        return $this;
    }

    public function selectRetryCount()
    {
        $this->selectField("retryCount");

        return $this;
    }

    public function selectState()
    {
        $this->selectField("state");

        return $this;
    }
}
