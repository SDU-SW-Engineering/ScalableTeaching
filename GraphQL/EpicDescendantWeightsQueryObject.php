<?php

namespace GraphQL\SchemaObject;

class EpicDescendantWeightsQueryObject extends QueryObject
{
    const OBJECT_NAME = "EpicDescendantWeights";

    public function selectClosedIssues()
    {
        $this->selectField("closedIssues");

        return $this;
    }

    public function selectOpenedIssues()
    {
        $this->selectField("openedIssues");

        return $this;
    }
}
