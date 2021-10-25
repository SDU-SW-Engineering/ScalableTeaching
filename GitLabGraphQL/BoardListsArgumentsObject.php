<?php

namespace GraphQL\SchemaObject;

class BoardListsArgumentsObject extends ArgumentsObject
{
    protected $id;
    protected $issueFilters;
    protected $after;
    protected $before;
    protected $first;
    protected $last;

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function setIssueFilters(BoardIssueInputInputObject $boardIssueInputInputObject)
    {
        $this->issueFilters = $boardIssueInputInputObject;

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
