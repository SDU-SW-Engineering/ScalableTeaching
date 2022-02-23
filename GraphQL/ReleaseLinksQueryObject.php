<?php

namespace GraphQL\SchemaObject;

class ReleaseLinksQueryObject extends QueryObject
{
    const OBJECT_NAME = "ReleaseLinks";

    public function selectClosedIssuesUrl()
    {
        $this->selectField("closedIssuesUrl");

        return $this;
    }

    public function selectClosedMergeRequestsUrl()
    {
        $this->selectField("closedMergeRequestsUrl");

        return $this;
    }

    public function selectEditUrl()
    {
        $this->selectField("editUrl");

        return $this;
    }

    public function selectMergedMergeRequestsUrl()
    {
        $this->selectField("mergedMergeRequestsUrl");

        return $this;
    }

    public function selectOpenedIssuesUrl()
    {
        $this->selectField("openedIssuesUrl");

        return $this;
    }

    public function selectOpenedMergeRequestsUrl()
    {
        $this->selectField("openedMergeRequestsUrl");

        return $this;
    }

    public function selectSelfUrl()
    {
        $this->selectField("selfUrl");

        return $this;
    }
}
