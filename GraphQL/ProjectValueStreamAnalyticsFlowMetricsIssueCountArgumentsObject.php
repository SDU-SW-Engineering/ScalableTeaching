<?php

namespace GraphQL\SchemaObject;

class ProjectValueStreamAnalyticsFlowMetricsIssueCountArgumentsObject extends ArgumentsObject
{
    protected $from;
    protected $to;
    protected $assigneeUsernames;
    protected $authorUsername;
    protected $milestoneTitle;
    protected $labelNames;

    public function setFrom($from)
    {
        $this->from = $from;

        return $this;
    }

    public function setTo($to)
    {
        $this->to = $to;

        return $this;
    }

    public function setAssigneeUsernames(array $assigneeUsernames)
    {
        $this->assigneeUsernames = $assigneeUsernames;

        return $this;
    }

    public function setAuthorUsername($authorUsername)
    {
        $this->authorUsername = $authorUsername;

        return $this;
    }

    public function setMilestoneTitle($milestoneTitle)
    {
        $this->milestoneTitle = $milestoneTitle;

        return $this;
    }

    public function setLabelNames(array $labelNames)
    {
        $this->labelNames = $labelNames;

        return $this;
    }
}
