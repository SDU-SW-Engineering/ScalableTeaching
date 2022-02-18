<?php

namespace GraphQL\SchemaObject;

class DesignCollectionDesignsArgumentsObject extends ArgumentsObject
{
    protected $atVersion;
    protected $filenames;
    protected $ids;
    protected $after;
    protected $before;
    protected $first;
    protected $last;

    public function setAtVersion($atVersion)
    {
        $this->atVersion = $atVersion;

        return $this;
    }

    public function setFilenames(array $filenames)
    {
        $this->filenames = $filenames;

        return $this;
    }

    public function setIds(array $ids)
    {
        $this->ids = $ids;

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
