<?php

namespace GraphQL\SchemaObject;

class UnionedIssueFilterInputInputObject extends InputObject
{
    protected $assigneeUsernames;
    protected $authorUsernames;
    protected $labelNames;

    public function setAssigneeUsernames(array $assigneeUsernames)
    {
        $this->assigneeUsernames = $assigneeUsernames;

        return $this;
    }

    public function setAuthorUsernames(array $authorUsernames)
    {
        $this->authorUsernames = $authorUsernames;

        return $this;
    }

    public function setLabelNames(array $labelNames)
    {
        $this->labelNames = $labelNames;

        return $this;
    }
}
