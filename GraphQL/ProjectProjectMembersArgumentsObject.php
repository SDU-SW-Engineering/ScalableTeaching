<?php

namespace GraphQL\SchemaObject;

use GraphQL\RawObject;

class ProjectProjectMembersArgumentsObject extends ArgumentsObject
{
    protected $search;
    protected $sort;
    protected $relations;
    protected $after;
    protected $before;
    protected $first;
    protected $last;

    public function setSearch($search)
    {
        $this->search = $search;

        return $this;
    }

    public function setSort($memberSort)
    {
        $this->sort = new RawObject($memberSort);

        return $this;
    }

    public function setRelations(array $relations)
    {
        $this->relations = $relations;

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
