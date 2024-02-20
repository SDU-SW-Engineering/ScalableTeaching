<?php

namespace GraphQL\SchemaObject;

use GraphQL\RawObject;

class CurrentUserSnippetsArgumentsObject extends ArgumentsObject
{
    protected $ids;
    protected $visibility;
    protected $type;
    protected $after;
    protected $before;
    protected $first;
    protected $last;

    public function setIds(array $ids)
    {
        $this->ids = $ids;

        return $this;
    }

    public function setVisibility($visibilityScopesEnum)
    {
        $this->visibility = new RawObject($visibilityScopesEnum);

        return $this;
    }

    public function setType($typeEnum)
    {
        $this->type = new RawObject($typeEnum);

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
