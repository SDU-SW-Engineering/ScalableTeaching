<?php

namespace GraphQL\SchemaObject;

class ExternalIssueQueryObject extends QueryObject
{
    const OBJECT_NAME = "ExternalIssue";

    public function selectCreatedAt()
    {
        $this->selectField("createdAt");

        return $this;
    }

    public function selectExternalTracker()
    {
        $this->selectField("externalTracker");

        return $this;
    }

    public function selectRelativeReference()
    {
        $this->selectField("relativeReference");

        return $this;
    }

    public function selectStatus()
    {
        $this->selectField("status");

        return $this;
    }

    public function selectTitle()
    {
        $this->selectField("title");

        return $this;
    }

    public function selectUpdatedAt()
    {
        $this->selectField("updatedAt");

        return $this;
    }

    public function selectWebUrl()
    {
        $this->selectField("webUrl");

        return $this;
    }
}
