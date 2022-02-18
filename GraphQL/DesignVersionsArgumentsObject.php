<?php

namespace GraphQL\SchemaObject;

class DesignVersionsArgumentsObject extends ArgumentsObject
{
    protected $earlierOrEqualToSha;
    protected $earlierOrEqualToId;
    protected $after;
    protected $before;
    protected $first;
    protected $last;

    public function setEarlierOrEqualToSha($earlierOrEqualToSha)
    {
        $this->earlierOrEqualToSha = $earlierOrEqualToSha;

        return $this;
    }

    public function setEarlierOrEqualToId($earlierOrEqualToId)
    {
        $this->earlierOrEqualToId = $earlierOrEqualToId;

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
