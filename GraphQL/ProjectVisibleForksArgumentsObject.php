<?php

namespace GraphQL\SchemaObject;

use GraphQL\RawObject;

class ProjectVisibleForksArgumentsObject extends ArgumentsObject
{
    protected $after;
    protected $before;
    protected $first;
    protected $last;
    protected $minimumAccessLevel;

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

    public function setMinimumAccessLevel($accessLevelEnum)
    {
        $this->minimumAccessLevel = new RawObject($accessLevelEnum);

        return $this;
    }
}
