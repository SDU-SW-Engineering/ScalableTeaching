<?php

namespace GraphQL\SchemaObject;

use GraphQL\RawObject;

class GroupContactsArgumentsObject extends ArgumentsObject
{
    protected $sort;
    protected $search;
    protected $state;
    protected $ids;
    protected $after;
    protected $before;
    protected $first;
    protected $last;

    public function setSort($contactSort)
    {
        $this->sort = new RawObject($contactSort);

        return $this;
    }

    public function setSearch($search)
    {
        $this->search = $search;

        return $this;
    }

    public function setState($customerRelationsContactState)
    {
        $this->state = new RawObject($customerRelationsContactState);

        return $this;
    }

    public function setIds(array $ids)
    {
        $this->ids = $ids;

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
