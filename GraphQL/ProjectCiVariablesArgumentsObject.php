<?php

namespace GraphQL\SchemaObject;

use GraphQL\RawObject;

class ProjectCiVariablesArgumentsObject extends ArgumentsObject
{
    protected $sort;
    protected $after;
    protected $before;
    protected $first;
    protected $last;

    public function setSort($ciVariableSort)
    {
        $this->sort = new RawObject($ciVariableSort);

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
