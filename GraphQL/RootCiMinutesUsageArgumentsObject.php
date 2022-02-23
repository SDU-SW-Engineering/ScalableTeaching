<?php

namespace GraphQL\SchemaObject;

class RootCiMinutesUsageArgumentsObject extends ArgumentsObject
{
    protected $after;
    protected $before;
    protected $first;
    protected $last;
    protected $namespaceId;

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

    public function setNamespaceId($namespaceId)
    {
        $this->namespaceId = $namespaceId;

        return $this;
    }
}
