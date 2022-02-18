<?php

namespace GraphQL\SchemaObject;

class ProjectNetworkPoliciesArgumentsObject extends ArgumentsObject
{
    protected $environmentId;
    protected $after;
    protected $before;
    protected $first;
    protected $last;

    public function setEnvironmentId($environmentId)
    {
        $this->environmentId = $environmentId;

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
