<?php

namespace GraphQL\SchemaObject;

class RepositoryPaginatedTreeArgumentsObject extends ArgumentsObject
{
    protected $path;
    protected $recursive;
    protected $ref;
    protected $after;
    protected $before;
    protected $first;
    protected $last;

    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    public function setRecursive($recursive)
    {
        $this->recursive = $recursive;

        return $this;
    }

    public function setRef($ref)
    {
        $this->ref = $ref;

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
