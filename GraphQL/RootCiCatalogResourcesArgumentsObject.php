<?php

namespace GraphQL\SchemaObject;

use GraphQL\RawObject;

class RootCiCatalogResourcesArgumentsObject extends ArgumentsObject
{
    protected $scope;
    protected $search;
    protected $sort;
    protected $after;
    protected $before;
    protected $first;
    protected $last;

    public function setScope($ciCatalogResourceScope)
    {
        $this->scope = new RawObject($ciCatalogResourceScope);

        return $this;
    }

    public function setSearch($search)
    {
        $this->search = $search;

        return $this;
    }

    public function setSort($ciCatalogResourceSort)
    {
        $this->sort = new RawObject($ciCatalogResourceSort);

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
