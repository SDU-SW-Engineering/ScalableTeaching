<?php

namespace GraphQL\SchemaObject;

class GroupReleaseStatsQueryObject extends QueryObject
{
    const OBJECT_NAME = "GroupReleaseStats";

    public function selectReleasesCount()
    {
        $this->selectField("releasesCount");

        return $this;
    }

    public function selectReleasesPercentage()
    {
        $this->selectField("releasesPercentage");

        return $this;
    }
}
