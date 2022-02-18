<?php

namespace GraphQL\SchemaObject;

use GraphQL\RawObject;

class GroupContainerRepositoriesArgumentsObject extends ArgumentsObject
{
    protected $name;
    protected $sort;
    protected $after;
    protected $before;
    protected $first;
    protected $last;

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function setSort($containerRepositorySort)
    {
        $this->sort = new RawObject($containerRepositorySort);

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
