<?php

namespace GraphQL\SchemaObject;

class GroupAutocompleteUsersArgumentsObject extends ArgumentsObject
{
    protected $search;

    public function setSearch($search)
    {
        $this->search = $search;

        return $this;
    }
}
