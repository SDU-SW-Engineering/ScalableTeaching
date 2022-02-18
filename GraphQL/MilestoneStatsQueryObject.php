<?php

namespace GraphQL\SchemaObject;

class MilestoneStatsQueryObject extends QueryObject
{
    const OBJECT_NAME = "MilestoneStats";

    public function selectClosedIssuesCount()
    {
        $this->selectField("closedIssuesCount");

        return $this;
    }

    public function selectTotalIssuesCount()
    {
        $this->selectField("totalIssuesCount");

        return $this;
    }
}
