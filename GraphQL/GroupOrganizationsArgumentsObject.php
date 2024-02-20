<?php

namespace GraphQL\SchemaObject;

use GraphQL\RawObject;

class GroupOrganizationsArgumentsObject extends ArgumentsObject
{
    protected $sort;
    protected $search;
    protected $state;
    protected $ids;
    protected $after;
    protected $before;
    protected $first;
    protected $last;

    public function setSort($organizationSort)
    {
        $this->sort = new RawObject($organizationSort);

        return $this;
    }

    public function setSearch($search)
    {
        $this->search = $search;

        return $this;
    }

    public function setState($customerRelationsOrganizationState)
    {
        $this->state = new RawObject($customerRelationsOrganizationState);

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
