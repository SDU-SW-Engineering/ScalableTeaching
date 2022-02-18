<?php

namespace GraphQL\SchemaObject;

class RootDevopsAdoptionEnabledNamespacesArgumentsObject extends ArgumentsObject
{
    protected $displayNamespaceId;
    protected $after;
    protected $before;
    protected $first;
    protected $last;

    public function setDisplayNamespaceId($displayNamespaceId)
    {
        $this->displayNamespaceId = $displayNamespaceId;

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
