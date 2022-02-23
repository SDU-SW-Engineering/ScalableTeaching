<?php

namespace GraphQL\SchemaObject;

use GraphQL\RawObject;

class ProjectServicesArgumentsObject extends ArgumentsObject
{
    protected $active;
    protected $type;
    protected $after;
    protected $before;
    protected $first;
    protected $last;

    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    public function setType($serviceType)
    {
        $this->type = new RawObject($serviceType);

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
