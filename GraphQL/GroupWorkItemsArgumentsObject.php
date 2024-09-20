<?php

namespace GraphQL\SchemaObject;

use GraphQL\RawObject;

class GroupWorkItemsArgumentsObject extends ArgumentsObject
{
    protected $search;
    protected $in;
    protected $iids;
    protected $state;
    protected $types;
    protected $iid;
    protected $sort;
    protected $after;
    protected $before;
    protected $first;
    protected $last;

    public function setSearch($search)
    {
        $this->search = $search;

        return $this;
    }

    public function setIn(array $in)
    {
        $this->in = $in;

        return $this;
    }

    public function setIids(array $iids)
    {
        $this->iids = $iids;

        return $this;
    }

    public function setState($issuableState)
    {
        $this->state = new RawObject($issuableState);

        return $this;
    }

    public function setTypes(array $types)
    {
        $this->types = $types;

        return $this;
    }

    public function setIid($iid)
    {
        $this->iid = $iid;

        return $this;
    }

    public function setSort($workItemSort)
    {
        $this->sort = new RawObject($workItemSort);

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
