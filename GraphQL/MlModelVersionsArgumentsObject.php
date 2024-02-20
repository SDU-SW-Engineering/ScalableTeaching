<?php

namespace GraphQL\SchemaObject;

use GraphQL\RawObject;

class MlModelVersionsArgumentsObject extends ArgumentsObject
{
    protected $version;
    protected $orderBy;
    protected $sort;
    protected $after;
    protected $before;
    protected $first;
    protected $last;

    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    public function setOrderBy($mlModelVersionsOrderBy)
    {
        $this->orderBy = new RawObject($mlModelVersionsOrderBy);

        return $this;
    }

    public function setSort($sortDirectionEnum)
    {
        $this->sort = new RawObject($sortDirectionEnum);

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
