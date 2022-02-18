<?php

namespace GraphQL\SchemaObject;

use GraphQL\RawObject;

class RootUsersArgumentsObject extends ArgumentsObject
{
    protected $ids;
    protected $usernames;
    protected $sort;
    protected $search;
    protected $admins;
    protected $after;
    protected $before;
    protected $first;
    protected $last;

    public function setIds(array $ids)
    {
        $this->ids = $ids;

        return $this;
    }

    public function setUsernames(array $usernames)
    {
        $this->usernames = $usernames;

        return $this;
    }

    public function setSort($sort)
    {
        $this->sort = new RawObject($sort);

        return $this;
    }

    public function setSearch($search)
    {
        $this->search = $search;

        return $this;
    }

    public function setAdmins($admins)
    {
        $this->admins = $admins;

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
