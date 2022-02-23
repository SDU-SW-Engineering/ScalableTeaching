<?php

namespace GraphQL\SchemaObject;

class ProjectAlertManagementAlertStatusCountsArgumentsObject extends ArgumentsObject
{
    protected $search;
    protected $assigneeUsername;

    public function setSearch($search)
    {
        $this->search = $search;

        return $this;
    }

    public function setAssigneeUsername($assigneeUsername)
    {
        $this->assigneeUsername = $assigneeUsername;

        return $this;
    }
}
