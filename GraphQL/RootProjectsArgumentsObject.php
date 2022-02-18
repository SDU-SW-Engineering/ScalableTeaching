<?php

namespace GraphQL\SchemaObject;

class RootProjectsArgumentsObject extends ArgumentsObject
{
    protected $membership;
    protected $search;
    protected $ids;
    protected $searchNamespaces;
    protected $sort;
    protected $topics;
    protected $after;
    protected $before;
    protected $first;
    protected $last;

    public function setMembership($membership)
    {
        $this->membership = $membership;

        return $this;
    }

    public function setSearch($search)
    {
        $this->search = $search;

        return $this;
    }

    public function setIds(array $ids)
    {
        $this->ids = $ids;

        return $this;
    }

    public function setSearchNamespaces($searchNamespaces)
    {
        $this->searchNamespaces = $searchNamespaces;

        return $this;
    }

    public function setSort($sort)
    {
        $this->sort = $sort;

        return $this;
    }

    public function setTopics(array $topics)
    {
        $this->topics = $topics;

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
