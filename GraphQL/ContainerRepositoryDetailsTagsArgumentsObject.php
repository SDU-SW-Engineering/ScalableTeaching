<?php

namespace GraphQL\SchemaObject;

use GraphQL\RawObject;

class ContainerRepositoryDetailsTagsArgumentsObject extends ArgumentsObject
{
    protected $sort;
    protected $name;
    protected $after;
    protected $before;
    protected $first;
    protected $last;

    public function setSort($containerRepositoryTagSort)
    {
        $this->sort = new RawObject($containerRepositoryTagSort);

        return $this;
    }

    public function setName($name)
    {
        $this->name = $name;

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
