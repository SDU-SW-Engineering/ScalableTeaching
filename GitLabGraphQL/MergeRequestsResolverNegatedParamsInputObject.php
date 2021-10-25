<?php

namespace GraphQL\SchemaObject;

class MergeRequestsResolverNegatedParamsInputObject extends InputObject
{
    protected $labels;
    protected $milestoneTitle;

    public function setLabels(array $labels)
    {
        $this->labels = $labels;

        return $this;
    }

    public function setMilestoneTitle($milestoneTitle)
    {
        $this->milestoneTitle = $milestoneTitle;

        return $this;
    }
}
