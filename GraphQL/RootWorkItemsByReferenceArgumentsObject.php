<?php

namespace GraphQL\SchemaObject;

class RootWorkItemsByReferenceArgumentsObject extends ArgumentsObject
{
    protected $contextNamespacePath;
    protected $refs;
    protected $after;
    protected $before;
    protected $first;
    protected $last;

    public function setContextNamespacePath($contextNamespacePath)
    {
        $this->contextNamespacePath = $contextNamespacePath;

        return $this;
    }

    public function setRefs(array $refs)
    {
        $this->refs = $refs;

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
