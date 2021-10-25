<?php

namespace GraphQL\SchemaObject;

class EpicDescendantCountQueryObject extends QueryObject
{
    const OBJECT_NAME = "EpicDescendantCount";

    public function selectClosedEpics()
    {
        $this->selectField("closedEpics");

        return $this;
    }

    public function selectClosedIssues()
    {
        $this->selectField("closedIssues");

        return $this;
    }

    public function selectOpenedEpics()
    {
        $this->selectField("openedEpics");

        return $this;
    }

    public function selectOpenedIssues()
    {
        $this->selectField("openedIssues");

        return $this;
    }
}
