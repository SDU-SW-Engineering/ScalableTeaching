<?php

namespace GraphQL\SchemaObject;

use GraphQL\RawObject;

class NamespaceProjectsArgumentsObject extends ArgumentsObject
{
    protected $includeSubgroups;
    protected $includeArchived;
    protected $notAimedForDeletion;
    protected $search;
    protected $sort;
    protected $ids;
    protected $withIssuesEnabled;
    protected $withMergeRequestsEnabled;
    protected $after;
    protected $before;
    protected $first;
    protected $last;

    public function setIncludeSubgroups($includeSubgroups)
    {
        $this->includeSubgroups = $includeSubgroups;

        return $this;
    }

    public function setIncludeArchived($includeArchived)
    {
        $this->includeArchived = $includeArchived;

        return $this;
    }

    public function setNotAimedForDeletion($notAimedForDeletion)
    {
        $this->notAimedForDeletion = $notAimedForDeletion;

        return $this;
    }

    public function setSearch($search)
    {
        $this->search = $search;

        return $this;
    }

    public function setSort($namespaceProjectSort)
    {
        $this->sort = new RawObject($namespaceProjectSort);

        return $this;
    }

    public function setIds(array $ids)
    {
        $this->ids = $ids;

        return $this;
    }

    public function setWithIssuesEnabled($withIssuesEnabled)
    {
        $this->withIssuesEnabled = $withIssuesEnabled;

        return $this;
    }

    public function setWithMergeRequestsEnabled($withMergeRequestsEnabled)
    {
        $this->withMergeRequestsEnabled = $withMergeRequestsEnabled;

        return $this;
    }

    public function setAfter($after)
    {
        $this->after = $after;

        return $this;
    }

    public function setBefore($before)
    {
        $this->before = $before;

        return $this;
    }

    public function setFirst($first)
    {
        $this->first = $first;

        return $this;
    }

    public function setLast($last)
    {
        $this->last = $last;

        return $this;
    }
}
