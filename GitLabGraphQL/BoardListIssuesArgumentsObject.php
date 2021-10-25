<?php

namespace GraphQL\SchemaObject;

class BoardListIssuesArgumentsObject extends ArgumentsObject
{
    protected $filters;
    protected $after;
    protected $before;
    protected $first;
    protected $last;

    public function setFilters(BoardIssueInputInputObject $boardIssueInputInputObject)
    {
        $this->filters = $boardIssueInputInputObject;

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
