<?php

namespace GraphQL\SchemaObject;

use GraphQL\RawObject;

class GroupWorkItemTypesArgumentsObject extends ArgumentsObject
{
    protected $name;
    protected $after;
    protected $before;
    protected $first;
    protected $last;

    public function setName($issueType)
    {
        $this->name = new RawObject($issueType);

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
