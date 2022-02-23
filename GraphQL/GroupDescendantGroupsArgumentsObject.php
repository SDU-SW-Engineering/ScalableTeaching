<?php

namespace GraphQL\SchemaObject;

class GroupDescendantGroupsArgumentsObject extends ArgumentsObject
{
    protected $includeParentDescendants;
    protected $owned;
    protected $search;
    protected $after;
    protected $before;
    protected $first;
    protected $last;

    public function setIncludeParentDescendants($includeParentDescendants)
    {
        $this->includeParentDescendants = $includeParentDescendants;

        return $this;
    }

    public function setOwned($owned)
    {
        $this->owned = $owned;

        return $this;
    }

    public function setSearch($search)
    {
        $this->search = $search;

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
