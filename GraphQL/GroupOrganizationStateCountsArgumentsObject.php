<?php

namespace GraphQL\SchemaObject;

use GraphQL\RawObject;

class GroupOrganizationStateCountsArgumentsObject extends ArgumentsObject
{
    protected $search;
    protected $state;

    public function setSearch($search)
    {
        $this->search = $search;

        return $this;
    }

    public function setState($customerRelationsOrganizationState)
    {
        $this->state = new RawObject($customerRelationsOrganizationState);

        return $this;
    }
}
