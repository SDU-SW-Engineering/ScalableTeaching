<?php

namespace GraphQL\SchemaObject;

use GraphQL\RawObject;

class RootRunnersArgumentsObject extends ArgumentsObject
{
    protected $paused;
    protected $status;
    protected $type;
    protected $tagList;
    protected $search;
    protected $sort;
    protected $after;
    protected $before;
    protected $first;
    protected $last;

    public function setPaused($paused)
    {
        $this->paused = $paused;

        return $this;
    }

    public function setStatus($ciRunnerStatus)
    {
        $this->status = new RawObject($ciRunnerStatus);

        return $this;
    }

    public function setType($ciRunnerType)
    {
        $this->type = new RawObject($ciRunnerType);

        return $this;
    }

    public function setTagList(array $tagList)
    {
        $this->tagList = $tagList;

        return $this;
    }

    public function setSearch($search)
    {
        $this->search = $search;

        return $this;
    }

    public function setSort($ciRunnerSort)
    {
        $this->sort = new RawObject($ciRunnerSort);

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
