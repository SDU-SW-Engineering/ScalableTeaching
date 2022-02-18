<?php

namespace GraphQL\SchemaObject;

use GraphQL\RawObject;

class RequirementTestReportsArgumentsObject extends ArgumentsObject
{
    protected $sort;
    protected $after;
    protected $before;
    protected $first;
    protected $last;

    public function setSort($sort)
    {
        $this->sort = new RawObject($sort);

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
