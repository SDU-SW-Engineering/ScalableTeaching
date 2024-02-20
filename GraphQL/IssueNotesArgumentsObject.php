<?php

namespace GraphQL\SchemaObject;

use GraphQL\RawObject;

class IssueNotesArgumentsObject extends ArgumentsObject
{
    protected $filter;
    protected $after;
    protected $before;
    protected $first;
    protected $last;

    public function setFilter($notesFilterType)
    {
        $this->filter = new RawObject($notesFilterType);

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
