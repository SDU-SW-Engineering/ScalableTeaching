<?php

namespace GraphQL\SchemaObject;

use GraphQL\RawObject;

class GroupWorkItemStateCountsArgumentsObject extends ArgumentsObject
{
    protected $search;
    protected $in;
    protected $iids;
    protected $state;
    protected $types;
    protected $iid;
    protected $sort;

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
}
