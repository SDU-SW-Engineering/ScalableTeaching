<?php

namespace GraphQL\SchemaObject;

class RepositoryBlobsArgumentsObject extends ArgumentsObject
{
    protected $paths;
    protected $ref;
    protected $after;
    protected $before;
    protected $first;
    protected $last;

    public function setPaths(array $paths)
    {
        $this->paths = $paths;

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
