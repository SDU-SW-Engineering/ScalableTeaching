<?php

namespace GraphQL\SchemaObject;

class PagesDeploymentRegistryQueryObject extends QueryObject
{
    const OBJECT_NAME = "PagesDeploymentRegistry";

    public function selectCreatedAt()
    {
        $this->selectField("createdAt");

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

    public function selectPagesDeploymentId()
    {
        $this->selectField("pagesDeploymentId");

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
