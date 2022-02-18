<?php

namespace GraphQL\SchemaObject;

use GraphQL\RawObject;

class EpicCurrentUserTodosArgumentsObject extends ArgumentsObject
{
    protected $after;
    protected $before;
    protected $first;
    protected $last;
    protected $state;

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

    public function setState($todoStateEnum)
    {
        $this->state = new RawObject($todoStateEnum);

        return $this;
    }
}
