<?php

namespace GraphQL\SchemaObject;

use GraphQL\RawObject;

class GroupContactStateCountsArgumentsObject extends ArgumentsObject
{
    protected $search;
    protected $state;

    public function setSearch($search)
    {
        $this->search = $search;

        return $this;
    }

    public function setState($customerRelationsContactState)
    {
        $this->state = new RawObject($customerRelationsContactState);

        return $this;
    }
}
