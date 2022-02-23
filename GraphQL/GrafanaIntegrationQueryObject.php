<?php

namespace GraphQL\SchemaObject;

class GrafanaIntegrationQueryObject extends QueryObject
{
    const OBJECT_NAME = "GrafanaIntegration";

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

    public function selectGrafanaUrl()
    {
        $this->selectField("grafanaUrl");

        return $this;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectUpdatedAt()
    {
        $this->selectField("updatedAt");

        return $this;
    }
}
