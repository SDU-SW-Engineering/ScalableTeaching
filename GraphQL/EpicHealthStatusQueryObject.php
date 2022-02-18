<?php

namespace GraphQL\SchemaObject;

class EpicHealthStatusQueryObject extends QueryObject
{
    const OBJECT_NAME = "EpicHealthStatus";

    public function selectIssuesAtRisk()
    {
        $this->selectField("issuesAtRisk");

        return $this;
    }

    public function selectIssuesNeedingAttention()
    {
        $this->selectField("issuesNeedingAttention");

        return $this;
    }

    public function selectIssuesOnTrack()
    {
        $this->selectField("issuesOnTrack");

        return $this;
    }
}
