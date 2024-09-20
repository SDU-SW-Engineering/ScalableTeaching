<?php

namespace GraphQL\SchemaObject;

use GraphQL\RawObject;

class MergeRequestAuthorGroupsArgumentsObject extends ArgumentsObject
{
    protected $permissionScope;
    protected $search;
    protected $after;
    protected $before;
    protected $first;
    protected $last;

    public function setPermissionScope($groupPermission)
    {
        $this->permissionScope = new RawObject($groupPermission);

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
