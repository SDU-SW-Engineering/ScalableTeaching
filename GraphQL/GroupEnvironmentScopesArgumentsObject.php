<?php

namespace GraphQL\SchemaObject;

class GroupEnvironmentScopesArgumentsObject extends ArgumentsObject
{
    protected $name;
    protected $search;
    protected $after;
    protected $before;
    protected $first;
    protected $last;

    public function setName($name)
    {
        $this->name = $name;

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
